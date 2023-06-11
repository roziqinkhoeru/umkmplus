<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\CourseEnroll;
use App\Models\Customer;
use App\Models\Mentor;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    public function mentorWithdraw()
    {
        $withdraws = Withdraw::where('customer_id', Auth::user()->id)->get();
        $balance = Mentor::where('customer_id', Auth::user()->id)->first()->balance;
        $revenue = Customer::where('customers.id', Auth::user()->id)
            ->leftJoin('courses', 'customers.id', '=', 'courses.mentor_id')
            ->leftJoin('course_enrolls', 'courses.id', '=', 'course_enrolls.course_id')
            ->whereIn('course_enrolls.status', ['aktif', 'selesai'])
            ->sum('course_enrolls.total_price');

        $data =
            [
                'title' => 'Withdraw | Mentor UMKMPlus',
                'active' => 'withdraw',
                'withdraws' => $withdraws,
                'balance' => $balance,
                'revenue' => $revenue * 0.8
            ];
        return view('mentor.withdraw.index', $data);
    }

    public function mentorWithdrawCreate()
    {
        $balance = Mentor::where('customer_id', Auth::user()->id)->first()->balance;
        if ($balance < 100000) {
            return redirect()->back()->with('error', 'Saldo anda tidak mencukupi');
        }
        $banks = ['BRI', 'Mandiri', 'BNI', 'BCA'];
        $data =
            [
                'title' => 'Permohonan Withdraw | Mentor UMKMPlus',
                'active' => 'withdraw',
                'balance' => $balance,
                'banks' => $banks
            ];

        return view('mentor.withdraw.create', $data);
    }

    public function mentorWithdrawStore()
    {
        $balance = Mentor::where('customer_id', Auth::user()->id)->first()->balance;
        $rules =
            [
                'amount' => 'required|numeric|min:10000|max:' . $balance,
                'bank' => 'required',
                'account_number' => 'required|numeric',
                'account_name' => 'required'
            ];
        $validator = validator(request()->all(), $rules);
        if ($validator->fails()) {
            return ResponseFormatter::error(
                $validator->errors(),
                'Gagal membuat permohonan withdraw',
                400
            );
        }

        $withdraw = Withdraw::create([
            'customer_id' => Auth::user()->id,
            'amount' => request('amount'),
            'bank' => request('bank'),
            'account_number' => request('account_number'),
            'account_name' => request('account_name'),
            'status' => 'pending'
        ]);

        if ($withdraw) {
            return ResponseFormatter::success(
                [
                    'redirect' => route('mentor.withdraw'),
                ],
                'Berhasil membuat permohonan withdraw'
            );
        }
        return ResponseFormatter::error(
            null,
            'Gagal membuat permohonan withdraw',
            400
        );
    }

    public function adminWithdraw(Request $request)
    {
        $revenue = CourseEnroll::whereIn('status', ['aktif', 'selesai'])->sum('total_price');
        $revenue = $revenue * 0.2;
        $data =
            [
                'title' => 'Withdraw | Admin UMKMPlus',
                'active' => 'withdraw',
                'revenue' => $revenue
            ];
        return view('admin.withdraw.index', $data);
    }

    function getAdminWithdraw()
    {
        $withdraws = Withdraw::with('customer')
            ->get();
        if ($withdraws) {
            return ResponseFormatter::success(
                [
                    'withdraws' => $withdraws,
                ],
                'Berhasil mengambil data'
            );
        }

        return ResponseFormatter::error(
            null,
            'Gagal mengambil data',
            400
        );
    }

    public function adminWithdrawEdit(Withdraw $withdraw)
    {
        $withdraw->load('customer.dataMentor');
        $data =
            [
                'title' => 'Withdraw | Admin UMKMPlus',
                'active' => 'withdraw',
                'withdraw' => $withdraw
            ];
        return view('admin.withdraw.pay', $data);
    }

    public function adminWithdrawUpdate(Request $request, Withdraw $withdraw)
    {
        $rules =
            [
                'paymentProof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ];
        $validator = validator(request()->all(), $rules);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                $validator->errors(),
                'Gagal mengupload bukti pembayaran',
                400
            );
        }

        try {
            DB::beginTransaction();
            $paymentProof = $request->file('paymentProof');
            $paymentProofUrl = $paymentProof->store('withdraw', 'public');

            $updateWithdraw = $withdraw->update([
                'payment_proof' => $paymentProofUrl,
                'status' => 'berhasil'
            ]);

            if (!$updateWithdraw) {
                throw new \Exception('Gagal mengupload bukti pembayaran');
            }

            $mentor = Mentor::where('customer_id', $withdraw->customer_id)->first();
            $mentor->balance = $mentor->balance - $withdraw->amount;
            $updateMentor = $mentor->save();

            if ($updateMentor) {
                DB::commit();
                return redirect()->route('admin.withdraw')->with('success', 'Berhasil mengupload bukti pembayaran');
            }

            throw new \Exception('Gagal mengupload bukti pembayaran');
        } catch (\Exception $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function adminWithdrawUpdateStatus(Request $request, Withdraw $withdraw)
    {
        $updateWithdraw = $withdraw->update([
            'status' => $request->status
        ]);
        if ($updateWithdraw) {
            return ResponseFormatter::success(
                [
                    'redirect' => route('admin.withdraw'),
                ],
                'Berhasil menolak permohonan withdraw'
            );
        }
        return ResponseFormatter::error(
            null,
            'Gagal menolak permohonan withdraw',
            400
        );
    }
}
