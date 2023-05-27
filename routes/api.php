<?php

use App\Http\Controllers\CourseEnrollController;
use App\Http\Controllers\EnrollTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/course/{course:title}/enroll/checkout', [EnrollTransaction::class, 'checkoutEnroll']);
Route::post('/checkout/midtrans-callback', [CourseEnrollController::class, 'midtransCallback'])->name('course.midtrans.callback');
