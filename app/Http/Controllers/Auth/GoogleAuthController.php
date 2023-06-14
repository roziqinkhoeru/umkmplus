<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();

            $finduserGoogleId = User::where('google_id', $user->id)->first();
            $finduserGoogleEmail = User::where('email', $user->email)->first();
            if ($finduserGoogleId) {
                Auth::login($finduserGoogleId);
                return redirect()->intended();
            } else if ($finduserGoogleEmail) {
                User::updated([
                    'google_id' => $user->id
                ]);
                Auth::login($finduserGoogleEmail);
                return redirect()->intended('/');
            } else {
                $newCustomer = Customer::create([
                    'name' => $user->name,
                    'profile_picture' => 'profile/profile-placeholder.png',
                    'phone' => '00000000000'
                ]);
                $newUser = User::create([
                    'customer_id' => $newCustomer->id,
                    'username' => $user->email,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make('Secret12345')
                ]);

                $newRoleUser = RoleUser::create([
                    'user_id' => $newUser->id,
                    'role_id' => 3,
                ]);

                Auth::login($newUser);
                return redirect()->intended();
            }
        } catch (\Throwable $th) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat melakukan autentikasi Google.');
        }
    }
}
