<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// auth
Route::get('/login', function () {
    return view('auth.login', ['title' => 'Login | UMKM Plus', 'ptSection' => '54px']);
});
Route::get('/register', function () {
    return view('auth.register', ['title' => 'Register | UMKM Plus', 'ptSection' => '54px']);
});
Route::get('/forgot-password', function () {
    return view('auth.forgotPassword', ['title' => 'Forgot Password | UMKM Plus', 'ptSection' => '54px']);
});
Route::get('/reset-password', function () {
    return view('auth.resetPassword', ['title' => 'Reset Password | UMKM Plus', 'ptSection' => '54px']);
});

// user
Route::get('/', function () {
    return view('welcome');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'create')->name('register');
    Route::post('/register', 'store');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout');
});
Route::controller(PasswordResetLinkController::class)->group(function () {
    Route::get('/forgot-password', 'create')->name('password.forgot');
    Route::post('/forgot-password', 'store')->name('forgotPassword');
});
Route::controller(NewPasswordController::class)->group(function () {
    Route::get('/reset-password/{token}', 'create')->name('password.reset');
    Route::post('/reset-password', 'store')->name('resetPassword');
});
