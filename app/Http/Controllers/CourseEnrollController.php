<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\MediaModule;
use App\Models\Module;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Nette\Utils\Strings;
use Ramsey\Uuid\Uuid;

class CourseEnrollController extends Controller
{
    public $serverKey;

    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
    }
    public function getCheckoutCourse(Course $course)
    {
        $student = Auth::user()->customer;
        // $status = "";
        // $dataTransaction = null;
        $courseEnroll = CourseEnroll::whereStudentId($student->id)->whereCourseId($course->id)->first();
        if ($courseEnroll && ($courseEnroll->status == 'proses' || $courseEnroll->status == 'menunggu pembayaran')) {
            return redirect($courseEnroll->snap_url);
        } else if ($courseEnroll && ($courseEnroll->status == 'aktif' || $courseEnroll->status == 'selesai') ) {
            return back()->with('error', 'Anda sudah terdaftar di kelas ini');
        }
        $course->discountPrice = ceil($course->price * $course->discount / 100);
        $data =
            [
                'title' => 'Checkout Kelas ' . $course->title .' | UMKMPlus',
                'course' => $course,
                // 'status' => $status,
                // 'dataTransaction' => $dataTransaction,
            ];

        return view('user.courseEnroll.checkout', $data);
    }

    public function getDiscountCourse(Request $request, Course $course)
    {
        $discount = Discount::whereCode($request->discount_code)->first();
        if (!$discount || $discount->mentor_id != $course->mentor_id) {
            return ResponseFormatter::error(
                [
                    'message' => 'Kode diskon tidak valid',
                ],
                'Kode diskon tidak valid',
                400
            );
        }

        return ResponseFormatter::success(
            [
                'priceDiscount' => $discount->discount,
                'discount' => $discount,
            ],
            'Kode diskon berhasil didapatkan'
        );
    }
    public function checkoutCourse(Request $request, Course $course)
    {
        $student = Auth::user()->customer;

        try {
            DB::beginTransaction();
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $orderID = Str::uuid()->toString();
            $discount_id = $request->discountID;
            $grossAmount = $request->priceCheckout;

            $params = array(
                'transaction_details' => [
                    'order_id' => $orderID,
                    'gross_amount' => $grossAmount,
                ],
                'customer_details' => [
                    'first_name' => $student->name,
                    'email' => $student->user->email,
                    'phone' => $student->phone,
                ],
            );

            $midtransTransaction = \Midtrans\Snap::createTransaction($params);
            $snapToken = $midtransTransaction->token;
            $snapURL = $midtransTransaction->redirect_url;

            if (!$snapToken) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Terjadi kesalahan saat mengambil token',
                    ],
                    'Terjadi kesalahan saat mengambil token',
                    500
                );
            }

            $courseEnroll = CourseEnroll::create([
                'id' => $orderID,
                'student_id' => $student->id,
                'course_id' => $course->id,
                'discount_id' => $discount_id,
                'status' => 'menunggu pembayaran',
                'total_price' => $grossAmount,
                'snap_token' => $snapToken,
                'snap_url' => $snapURL,
            ]);

            if (!$courseEnroll) {
                DB::rollBack();
                return ResponseFormatter::error(
                    [
                        'message' => 'Terjadi kesalahan saat membuat transaksi',
                    ],
                    'Terjadi kesalahan saat membuat transaksi',
                    500
                );
            }

            DB::commit();

            $data =
                [
                    'snapToken' => $snapToken,
                    'snapURL' => $snapURL,
                    'orderID' => $orderID,
                    'priceCheckout' => $grossAmount,
                ];

            return response()->json(['data' => $data,]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function midtransCallback(Request $request)
    {
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        $notif = new \Midtrans\Notification();

        $verifSignatureKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . \Midtrans\Config::$serverKey);

        if ($verifSignatureKey == $request->signature_key) {
            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $order_id = $notif->order_id;
            $fraud = $notif->fraud_status;
            $courseEnroll = CourseEnroll::find($order_id);

            if ($transaction == 'capture') {
                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $courseEnroll->update([
                            'status' => 'menunggu pembayaran',
                        ]);
                    } else {
                        $courseEnroll->update([
                            'status' => 'aktif',
                            'started_at' => Carbon::now(),
                            'upto_no_module' => 1,
                            'upto_no_media' => 1,
                        ]);
                    }
                }
            } else if ($transaction == 'settlement') {
                $courseEnroll->update([
                    'status' => 'aktif',
                    'started_at' => Carbon::now(),
                ]);
            } else if ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
                $courseEnroll->delete();
            }
        }
    }

    public function destroy(CourseEnroll $courseEnroll)
    {
        $courseEnroll->delete();
        return ResponseFormatter::success(
            [
                'message' => 'Transaksi berhasil dibatalkan',
            ],
            'Transaksi berhasil dibatalkan'
        );
    }

    public function coursePlaying(CourseEnroll $courseEnroll)
    {
        $courseEnroll->load('course.modules.mediaModules');
        $user = Auth::user()->customer;
        $student = Customer::where('id', $user->id)->first();
        // if student not have access to this course
        if ($student->id != $courseEnroll->student_id) {
            return back()->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        // if student not buy yet this course
        if (!($courseEnroll->status == 'aktif' || $courseEnroll->status == 'selesai')) {
            return back()->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        $noModule = Module::where('course_id', $courseEnroll->course->id)->where('no_module', $courseEnroll->upto_no_module)->first()->id;

        $lastMedia = MediaModule::where('module_id', $noModule)->where('no_media', $courseEnroll->upto_no_media)->first();
        // dd($lastMedia);

        $data = [
            'title' => 'Belajar '. $courseEnroll->title .' | Admin UMKMPlus',
            'active' => 'course',
            'courseEnroll' => $courseEnroll,
            'lastMedia' => $lastMedia,
        ];

        return view('user.courses.play', $data);
    }

    public function coursePlayingMedia(CourseEnroll $courseEnroll)
    {
        $user = Auth::user()->customer;
        $student = Customer::where('id', $user->id)->first();
        // if student not have access to this media
        if ($student->id != $courseEnroll->student_id) {
            return ResponseFormatter::error(
                [
                    'message' => 'Anda tidak memiliki akses ke halaman ini',
                ],
                'Anda tidak memiliki akses ke halaman ini',
                403
            );
        }

        // if student not buy yet this course
        if (!($courseEnroll->status == 'aktif' || $courseEnroll->status == 'selesai')) {
            return ResponseFormatter::error(
                [
                    'message' => 'Anda tidak memiliki akses ke halaman ini',
                ],
                'Anda tidak memiliki akses ke halaman ini',
                403
            );
        }
        $mediaModule = MediaModule::with('module')->where('id', request()->id)->first();
        if ($mediaModule->module->course_id != $courseEnroll->course_id) {
            return ResponseFormatter::error(
                [
                    'message' => 'Anda tidak memiliki akses ke halaman ini',
                ],
                'Anda tidak memiliki akses ke halaman ini',
                403
            );
        }

        if ($courseEnroll->upto_no_module < $mediaModule->module->no_module) {
            $courseEnroll->update([
                'upto_no_module' => $mediaModule->module->no_module,
                'upto_no_media' => $mediaModule->no_media,
            ]);
        } else if ($courseEnroll->upto_no_module == $mediaModule->module->no_module) {
            if ($courseEnroll->upto_no_media < $mediaModule->no_media) {
                $courseEnroll->update([
                    'upto_no_media' => $mediaModule->no_media,
                ]);
            }
        }

        $countModule = Module::where('course_id', $courseEnroll->course_id)->count();
        $lastMediaCourse = MediaModule::where('module_id', $countModule)->max('no_media');;

        $nextMedia = MediaModule::where('module_id', $mediaModule->module_id)->where('no_media', $mediaModule->no_media + 1)->first();
        if ($nextMedia && $nextMedia->module->course_id == $courseEnroll->course_id) {
            $next = $nextMedia->id;
        } else {
            $nextMedia = MediaModule::where('module_id', $mediaModule->module_id + 1)->where('no_media', 1)->first();
            if ($nextMedia && $nextMedia->module->course_id == $courseEnroll->course_id) {
                $next = $nextMedia->id;
            } else if($countModule == $courseEnroll->upto_no_module && $lastMediaCourse == $courseEnroll->upto_no_media) {
                if ($courseEnroll->course->google_form && $courseEnroll->status != 'selesai') {
                    $next = "test";
                } else {
                    $next = "finish";
                }
            }
        }

        return ResponseFormatter::success(
            [
                'message' => 'Berhasil mengambil data',
                'mediaModule' => $mediaModule,
                'next' => $next,
            ],
            'Berhasil mengambil data'
        );
    }

    public function coursePlayingTest(CourseEnroll $courseEnroll)
    {
        $course = Course::where('id', $courseEnroll->course_id)->first();
        $data = [
            'title' => 'Belajar '. $courseEnroll->title .' | Admin UMKMPlus',
            'active' => 'course',
            'courseEnroll' => $courseEnroll,
            'course' => $course,
        ];

        return view('user.courses.test', $data);
    }

    public function coursePlayingTestFinish(CourseEnroll $courseEnroll)
    {
        $courseEnroll->update([
            'status' => 'selesai',
            'finished_at' => Carbon::now(),
        ]);

        return Redirect::route('profile')->with('success', 'Selamat, Anda telah menyelesaikan Kelas ini');
    }
}
