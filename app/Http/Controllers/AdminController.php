<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin | Admin UMKMPlus',
            'active' => 'dashboard'
        ];

        return view('admin.dashboard', $data);
    }

    public function profile()
    {
        $admin = User::with('customer')->where('customer_id', Auth::user()->customer->id)->first();
        $data = [
            'title' => 'Profile ' . $admin->customer->name . ' | Admin UMKMPlus',
            'active' => 'profile',
            'admin' => $admin,
        ];

        return view('admin.profile.index', $data);
    }


    public function adminUpdateProfile(Request $request)
    {
        $user = Auth::user();
        $admin = $user->customer;
        try {
            DB::beginTransaction();

            $rules = [
                'name' => 'required|min:3',
                'username' => 'required|min:3|max:25|unique:users,username,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'required|numeric',
                'gender' => 'required',
                'address' => 'required|min:3',
                'dob' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                // Form salah diisi
                return $request->ajax()
                    ? ResponseFormatter::error(
                        [
                            'error' => $validator->errors()->first(),
                        ],
                        'Harap isi form dengan benar',
                        400,
                    )
                    : back()->with(['error' => $validator->errors()]);
            }

        $dob = Carbon::createFromFormat('d/m/Y', $request->dob)->toDateString();

            // update customer
            $updateCustomer = $admin->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
                'dob' => $dob,
            ]);

            if (!$updateCustomer) {
                throw new Exception('Gagal memperbarui data admin.');
            }

            // update user
            $updateUser = User::whereId($user->id)->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);

            if (!$updateUser) {
                throw new Exception('Gagal memperbarui data user.');
            } else {
                DB::commit();
                return $request->ajax()
                    ? ResponseFormatter::success(
                        [
                            'redirect' => redirect('/admin/profile')->getTargetUrl(),
                        ],
                        'Update profil berhasil',
                    ) : redirect('/admin/profile')->with('success', 'Update profil berhasil');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => $e->getMessage(),
                    ],
                    'Update profil gagal',
                    400,
                ) : back()->withInput()->withErrors(['error' => $e->getMessage()]);

        }
    }
}
