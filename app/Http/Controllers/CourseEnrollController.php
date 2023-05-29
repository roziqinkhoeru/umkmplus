<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\Customer;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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
        $status = "";
        $dataTransaction = null;
        $courseEnroll = CourseEnroll::whereStudentId($student->id)->whereCourseId($course->id)->first();
        if ($courseEnroll && ($courseEnroll->status == 'proses' || $courseEnroll->status == 'menunggu pembayaran')) {
            $status = "pending";
            $dataTransaction = Http::withBasicAuth($this->serverKey, '')->get('https://api.sandbox.midtrans.com/v2/' . $courseEnroll->id . '/status');
        }
        $data =
            [
                'title' => 'Checkout Kelas ' . $course->title .' | UMKMPlus',
                'course' => $course,
                'status' => $status,
                'dataTransaction' => $dataTransaction,
            ];

        return view('user.courseEnroll.checkout', $data);
    }

    public function getDiscountCourse(Request $request, Course $course)
    {
        $discount = Discount::whereCode($request->discount_code)->first();
        $priceDiscount = $course->price;
        if (!$discount || $discount->mentor_id != $course->mentor_id) {
            return ResponseFormatter::error(
                [
                    'message' => 'Kode diskon tidak valid',
                ],
                'Kode diskon tidak valid',
                400
            );
        } else {
            $priceDiscount = intval($course->price * $discount->discount / 100);
        }
        return ResponseFormatter::success(
            [
                'priceDiscount' => $priceDiscount,
                'discountID' => $discount->id,
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
            $grossAmount = $request->priceDiscount;

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

            $snapToken = \Midtrans\Snap::getSnapToken($params);

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
                    'orderID' => $orderID,
                    'priceDiscount' => $grossAmount,
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
                        ]);
                    }
                }
            } else if ($transaction == 'settlement') {
                $courseEnroll->update([
                    'status' => 'aktif',
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
}
