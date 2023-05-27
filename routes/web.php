<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\GoogleAuthController;

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

// user
Route::get('/', function () {
    return view('user.home', ['title' => 'UMKMPlus']);
});
Route::get('/course/category', function () {
    return view('user.courses.category', ['title' => 'Kategori Kelas | UMKMPlus']);
});
Route::get('/course/category/categoryName', function () {
    return view('user.courses.index', ['title' => 'Kelas _categoryName_ | UMKMPlus']);
});;
Route::get('/course/courseName', function () {
    return view('user.courses.detail', ['title' => '_courseName_ | UMKMPlus']);
});
Route::get('/mentor', function () {
    return view('user.mentors.index', ['title' => 'Mentor Terpopuler | UMKMPlus']);
});
Route::get('/mentor/mentorName', function () {
    return view('user.mentors.detail', ['title' => 'Mentor _namaMentor_ | UMKMPlus']);
});

// Auth
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

// Auth Google
Route::controller(GoogleAuthController::class)->group(function () {
    Route::get('/auth/google', 'redirectToGoogle')->name('google.redirect');
    Route::get('/auth/google/callback', 'handleGoogleCallback');
});
