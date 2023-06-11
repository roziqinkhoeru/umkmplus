<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        $data = [
            'title' => 'Lupa Password | UMKMPlus',
            'ptSection' => '54px',
        ];
        return view('auth.forgotPassword', $data);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Form salah diisi
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => $validator->errors()->get('email'),
                    ],
                    $validator->errors()->get('email'),
                    400,
                )
                : back()->with(['error' => $validator->errors()]);
        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink($request->only('email'));

        if ($status == Password::RESET_LINK_SENT) {
            return $request->ajax()
                ? ResponseFormatter::success(
                    [
                        'message' => __($status),
                    ],
                    __($status),
                )
                : back()->with(['success' => __($status)]);
        } else {
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => __($status),
                    ],
                    __($status),
                    400,
                )
                : back()->withInput($request->only('email'))->withErrors(['error' => __($status)]);
        }
    }

    /**
     * Display the password reset link request view.
     */
    public function adminCreate(): View
    {
        $data = [
            'title' => 'Lupa Password | Admin UMKMPlus'
        ];
        return view('admin.auth.forgotPassword', $data);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function adminStore(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Form salah diisi
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => $validator->errors()->get('email'),
                    ],
                    $validator->errors()->get('email'),
                    400,
                )
                : back()->with(['error' => $validator->errors()]);
        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink($request->only('email'));

        if ($status == Password::RESET_LINK_SENT) {
            return $request->ajax()
                ? ResponseFormatter::success(
                    [
                        'message' => __($status),
                    ],
                    __($status),
                )
                : back()->with(['success' => __($status)]);
        } else {
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => __($status),
                    ],
                    __($status),
                    400,
                )
                : back()->withInput($request->only('email'))->withErrors(['error' => __($status)]);
        }
    }
}
