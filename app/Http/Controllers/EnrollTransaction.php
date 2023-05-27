<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\Customer;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EnrollTransaction extends Controller
{
    public function checkoutEnroll(Request $request, Course $course)
    {
        $rules = [
            'student_id' => 'required|exists:customers,id',
            // 'course_id' => 'required|exists:courses,id',
            'bank' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['message' => "Data tidak valid", 'errors' => $validator->errors()], 400);
        }

        try {
            DB::beginTransaction();
            $serverKey = config('midtrans.server_key');

            $orderID = Str::uuid()->toString();
            $discount_id = $request->discount_id;
            if ($discount_id) {
                $discount = Discount::find($discount_id);
                $grossAmount = $course->price * $discount->discount / 100;
            } else {
                $grossAmount = $course->price;
            }

            $student = Customer::with('user')->find($request->student_id);

            // Request to midtrans
            $response = Http::withBasicAuth($serverKey, '')
                ->post(
                    config('midtrans.midtrans_endpoint'),
                    [
                        'payment_type' => 'bank_transfer',
                        'transaction_details' => [
                            'order_id' => $orderID,
                            'gross_amount' => $grossAmount,
                        ],
                        'customer_details' => [
                            'first_name' => $student->name,
                            'email' => $student->user->email,
                            'phone' => $student->phone,
                        ],
                        'bank_transfer' => [
                            'bank' => $request->bank
                        ],
                    ]
                );

            if ($response->failed()) {
                DB::rollBack();
                return response()->json(['message' => "Terjadi kesalahan pada server", 'errors' => $response->json()], 500);
            }

            $result = $response->json();
            if ($result['status_code'] != 201) {
                DB::rollBack();
                return response()->json(['message' => "Terjadi kesalahan pada server", 'errors' => $result['status_message']], 500);
            }

            CourseEnroll::create([
                'id' => $orderID,
                'student_id' => $request->student_id,
                'course_id' => $course->id,
                'discount_id' => $discount_id,
                'status' => 'menunggu pembayaran',
                'total_price' => $grossAmount,
            ]);

            DB::commit();

            return response()->json($response->json(), 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => "Terjadi kesalahan pada server", 'errors' => $e->getMessage()], 500);
        }
    }
}
