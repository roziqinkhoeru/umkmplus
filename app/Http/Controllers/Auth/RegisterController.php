<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function create()
    {
        $data = [
            'title' => 'Register | UMKM Plus',
            'ptSection' => '54px'
        ];
        return view('auth.register', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'address' => 'required',
            'phone' => 'required|numeric',
            'dob' => 'required',
            'username' => 'required|min:3|max:25|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Form salah diisi
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => $validator->errors(),
                    ],
                    'Harap isi form dengan benar',
                    400,
                )
                : back()->with(['error' => $validator->errors()]);
        }

        // create customer
        $customer = Customer::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'dob' => $request->dob,
        ]);

        // create user
        $user = User::create([
            'username' => $request->username,
            'customer_id' => $customer->id,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash::make() untuk mengenkripsi password
        ]);

        RoleUser::create([
            'user_id' => $user->id,
            'role_id' => $request->role_id,
        ]);

        if ($user) {
            return $request->ajax()
            ? ResponseFormatter::success(
                [
                    'redirect' => redirect('/login'),
                ],
                'Register success',
            ) : redirect('/login')->with('success', 'Register success');
        }

        return $request->ajax()
            ? ResponseFormatter::error(
                [
                    'error' => 'Register failed',
                ],
                'Register failed',
                400,
            ) : back()->withInput()->withErrors(['error' => 'Register failed']);
    }
}
