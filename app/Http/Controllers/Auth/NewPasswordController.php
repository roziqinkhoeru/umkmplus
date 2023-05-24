<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(string $token, Request $request): View
    {
        $data = [
            'title' => 'Reset Password | UMKM Plus',
            'ptSection' => '54px',
            'token' => $token,
            'email' => $request->email
        ];
        return view('auth.reset-password', $data);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Form salah diisi
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => $validator->errors(),
                    ],
                    $validator->errors()->all(),
                    400,
                )
                : back()->with(['error' => $validator->errors()]);
        }

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user) use ($request) {
            $user
                ->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])
                ->save();

            event(new PasswordReset($user));
        });

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        $redirectSuccess = redirect(route('signin'))->with('status', __($status));
        $redirectError = back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
        if ($status == Password::PASSWORD_RESET) {
            return $request->ajax() ? ResponseFormatter::success(['redirect' => $redirectSuccess->getTargetUrl()], __($status)) : redirect(route('signin'))->with('status', __($status));
        } else {
            return $request->ajax() ? ResponseFormatter::error(['redirect' => $redirectError->getTargetUrl()], __($status), 400) : redirect(route('signin'))->with('status', __($status));
        }
    }
}