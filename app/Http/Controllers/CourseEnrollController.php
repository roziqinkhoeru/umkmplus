<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Cart;
use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\MediaModule;
use App\Models\Mentor;
use App\Models\Module;
use App\Models\Testimonial;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        if ($course->status == 'nonaktif') {
            return abort(404);
        }
        $student = Auth::user()->customer;
        $courseEnroll = CourseEnroll::whereStudentId($student->id)->whereCourseId($course->id)->first();
        if ($courseEnroll && ($courseEnroll->status == 'proses' || $courseEnroll->status == 'menunggu pembayaran')) {
            return redirect($courseEnroll->snap_url);
        } else if ($courseEnroll && ($courseEnroll->status == 'aktif' || $courseEnroll->status == 'selesai')) {
            return back()->with('error', 'Anda sudah terdaftar di kelas ini');
        }
        $course->discountPrice = ceil($course->price * $course->discount / 100);
        $data =
            [
                'title' => 'Checkout Kelas ' . $course->title . ' | UMKMPlus',
                'course' => $course,
            ];

        return view('user.courseEnroll.checkout', $data);
    }

    public function getDiscountCourse(Request $request, Course $course)
    {
        $discountCode = Str::upper($request->discount_code);
        $discount = Discount::whereCode($discountCode)->first();
        // check if discount code belong to this mentor
        if (!$discount || $discount->mentor_id != $course->mentor_id) {
            return ResponseFormatter::error(
                [
                    'message' => 'Kode diskon tidak valid',
                ],
                'Kode diskon tidak valid',
                400
            );
        }

        // check if student ever enroll course from this mentor
        $student = Auth::user()->customer;
        $courseMentor = Course::whereMentorId($course->mentor_id)->pluck('id')->toArray();
        $courseEnrollMentor = CourseEnroll::whereStudentId($student->id)->whereIn('course_id', $courseMentor)->first();
        if (!$courseEnrollMentor) {
            return ResponseFormatter::error(
                [
                    'message' => 'Kode diskon tidak valid',
                ],
                'Kode diskon tidak valid',
                400
            );
        }

        // check if discount code is already used
        $discountEnroll = CourseEnroll::whereStudentId($student->id)->pluck('discount_id')->toArray();
        if (in_array($discount->id, $discountEnroll)) {
            return ResponseFormatter::error(
                [
                    'message' => 'Kode diskon sudah digunakan',
                ],
                'Kode diskon sudah digunakan',
                400
            );
        }

        // check if discount code is nonactive
        if ($discount->status == 0) {
            return ResponseFormatter::error(
                [
                    'message' => 'Kode diskon tidak aktif',
                ],
                'Kode diskon tidak aktif',
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
        $course->discountPrice = ceil($course->price * $course->discount / 100);
        $priceCheckout = $course->price - $course->discountPrice;
        $student = Auth::user()->customer;

        try {
            $orderID = Str::uuid()->toString();
            // check if course is free
            if ($course->price == 0) {
                $courseEnroll = CourseEnroll::create([
                    'id' => $orderID,
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                    'total_price' => $course->price,
                    'status' => 'aktif',
                    'started_at' => Carbon::now(),
                    'upto_no_module' => 1,
                    'upto_no_media' => 1,
                ]);
                if (!$courseEnroll) {
                    throw new Exception('Terjadi kesalahan saat membuat transaksi.');
                }
                DB::commit();
                return ResponseFormatter::success(
                    [
                        'redirect' => url('/course/playing/' . $orderID),
                        'message' => "Pembelian kelas berhasil"
                    ],
                    "Pembelian kelas berhasil"
                );
            } else if ($request->discountID) {
                // check if student use the referral code
                $discount = Discount::find($request->discountID);
                $grossAmount = $priceCheckout - $discount->discount;

                // check if gross amount is free
                if ($grossAmount <= 0) {
                    $grossAmount = 0;
                    $courseEnroll = CourseEnroll::create([
                        'id' => $orderID,
                        'student_id' => $student->id,
                        'course_id' => $course->id,
                        'discount_id' => $request->discountID,
                        'total_price' => $grossAmount,
                        'status' => 'aktif',
                        'started_at' => Carbon::now(),
                        'upto_no_module' => 1,
                        'upto_no_media' => 1,
                    ]);
                    if (!$courseEnroll) {
                        throw new Exception('Terjadi kesalahan saat membuat transaksi.');
                    }
                    DB::commit();
                    return ResponseFormatter::success(
                        [
                            'redirect' => url('/course/playing/' . $orderID),
                            'message' => "Pembelian kelas berhasil"
                        ],
                        "Pembelian kelas berhasil"
                    );
                }
            } else {
                $grossAmount = $priceCheckout;
            }

            DB::beginTransaction();
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;


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
                throw new Exception('Terjadi kesalahan saat membuat transaksi.');
            }

            $courseEnroll = CourseEnroll::create([
                'id' => $orderID,
                'student_id' => $student->id,
                'course_id' => $course->id,
                'discount_id' => $request->discountID,
                'status' => 'menunggu pembayaran',
                'total_price' => $grossAmount,
                'snap_token' => $snapToken,
                'snap_url' => $snapURL,
            ]);

            if (!$courseEnroll) {
                throw new Exception('Terjadi kesalahan saat membuat transaksi.');
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
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => $e->getMessage(),
                    ],
                    'Transaksi gagal, mohon coba beberapa saat lagi',
                    400,
                ) : back()->withInput()->withErrors(['error' => $e->getMessage()]);
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
            $courseEnroll = CourseEnroll::with('course')->find($order_id);
            $courseEnroll->update([
                'status' => 'proses'
            ]);
            $mentor = Mentor::where('customer_id', $courseEnroll->course->mentor_id)->first();

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
                        $mentor->balance += ($courseEnroll->total_price * 0.8);
                        $mentor->save();

                        // check if course in cart
                        $existCart = Cart::where('course_id', $courseEnroll->course_id)->where('student_id', $courseEnroll->student_id)->first();
                        if ($existCart) {
                            $existCart->delete();
                        }
                    }
                }
            } else if ($transaction == 'settlement') {
                $courseEnroll->update([
                    'status' => 'aktif',
                    'started_at' => Carbon::now(),
                    'upto_no_module' => 1,
                    'upto_no_media' => 1,
                ]);
                $mentor->balance += ($courseEnroll->total_price * 0.8);
                $mentor->save();

                // check if course in cart
                $existCart = Cart::where('course_id', $courseEnroll->course_id)->where('student_id', $courseEnroll->student_id)->first();
                if ($existCart) {
                    $existCart->delete();
                }
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

        // check if course is finished
        if ($courseEnroll->status != 'selesai') {
            $noModule = Module::where('course_id', $courseEnroll->course->id)->where('no_module', $courseEnroll->upto_no_module)->first()->id;
            $lastMedia = MediaModule::where('module_id', $noModule)->where('no_media', $courseEnroll->upto_no_media)->first();
        } else {
            $noModule = Module::where('course_id', $courseEnroll->course->id)->where('no_module', 1)->first()->id;
            $lastMedia = MediaModule::where('module_id', $noModule)->where('no_media', $courseEnroll->upto_no_media)->first();
        }

        // check if have request
        if (request()->content) {
            $noModule = MediaModule::find(request()->content)->module->no_module;
        }

        $data = [
            'title' => 'Belajar Kelas ' . $courseEnroll->course->title . ' | UMKMPlus',
            'active' => 'course',
            'noModule' => $noModule,
            'courseEnroll' => $courseEnroll,
            'lastMedia' => $lastMedia ? $lastMedia : null,
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
        // if student not buy yet this course
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

        // update upto no module and media
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
        $lastMedia = MediaModule::where('module_id', $mediaModule->module_id)->orderBy('no_media', 'desc')->first();

        // get next media
        $nextMedia = MediaModule::where('module_id', $mediaModule->module_id)->where('no_media', $mediaModule->no_media + 1)->first();
        if ($nextMedia) {
            $next = $nextMedia->id;
        } else {
            $nextModule = Module::where('course_id', $courseEnroll->course_id)->where('no_module', $mediaModule->module->no_module + 1)->first();
            if ($nextModule != null && $nextModule->no_module <= $countModule) {
                $nextMedia = MediaModule::where('module_id', $nextModule->id)->where('no_media', 1)->first();
                $next = $nextMedia->id;
            } else if ($courseEnroll->upto_no_module == $countModule) {
                if ($courseEnroll->course->google_form != null && $courseEnroll->status != 'selesai') {
                    $next = "test";
                } else {
                    $next = "settle";
                }
            } else {
                $next = "finish";
            }
        }
        $idBefore = request()->idBefore;
        if ($idBefore == null) {
            $idBefore = Module::where('course_id', $courseEnroll->course_id)->where('no_module', 1)->first()->id;
        }
        $beforeNoModule = MediaModule::find($idBefore)->module->no_module;

        return ResponseFormatter::success(
            [
                'message' => 'Berhasil mengambil data',
                'mediaModule' => $mediaModule,
                'beforeNoModule' =>  $beforeNoModule,
                'noModule' => $mediaModule->module->no_module,
                'next' => $next,
            ],
            'Berhasil mengambil data'
        );
    }

    public function coursePlayingTest(CourseEnroll $courseEnroll)
    {
        $course = Course::where('id', $courseEnroll->course_id)->first();
        $data = [
            'title' => 'Belajar Kelas ' . $courseEnroll->title . ' | UMKMPlus',
            'active' => 'course',
            'courseEnroll' => $courseEnroll,
            'course' => $course,
        ];

        return view('user.courses.test', $data);
    }

    public function coursePlayingTestFinish(CourseEnroll $courseEnroll)
    {
        $courseEnroll->update([
            'upto_no_module' => $courseEnroll->course->modules->count() + 1,
            'upto_no_media' => 1,
            'status' => 'selesai',
            'finished_at' => Carbon::now(),
        ]);

        return Redirect::route('profile')->with('success', 'Selamat, Anda telah menyelesaikan Kelas ini');
    }

    public function courseCertificate(CourseEnroll $courseEnroll)
    {
        $testimonial = Testimonial::where('course_enroll_id', $courseEnroll->id)->first();
        if (!$testimonial) {
            return redirect()->route('course.testimonial', $courseEnroll->id);
        }
        if ($courseEnroll->score == null) {
            return redirect()->route('profile', "content=course")->with('error', 'Mentor belum memberikan nilai');
        } else if ($courseEnroll->score == 0) {
            return redirect()->route('course.playing.test', $courseEnroll->id);
        }

        $fileName = 'UMKMPlus-' . $courseEnroll->course->title . '-' . $courseEnroll->student->name . '.pdf';

        return response()->download(storage_path('app/public/certificates/' . $fileName));
    }

    public function courseStudentTestimonial(CourseEnroll $courseEnroll)
    {
        $testimonial = Testimonial::with('courseEnroll.course')->where('course_enroll_id', $courseEnroll->id)->first();
        if ($testimonial) {
            return redirect()->route('course.certificate', $courseEnroll->id);
        }

        $courseEnroll->load('course');
        $data =
            [
                'title' => 'Testimonial Kelas ' . $courseEnroll->title . ' | UMKM Plus',
                'courseEnroll' => $courseEnroll
            ];

        return view('user.testimonials.create', $data);
    }
}
