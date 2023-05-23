<?php

use Illuminate\Support\Facades\Route;

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
