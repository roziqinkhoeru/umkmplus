<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseEnrollController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MentorController;
use Symfony\Component\Routing\RouteCompiler;

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

Route::get('/checkout/courseName', function () {
    return view('user.checkout', ['title' => 'Checkout Kelas _courseName_ | UMKMPlus']);
});

Route::get('/blog', function () {
    return view('user.blog.index', ['title' => 'Blog | UMKMPlus']);
});
Route::get('/blog/blogName', function () {
    return view('user.blog.detail', ['title' => '_blogName_ | UMKMPlus']);
});

// Auth
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'create')->name('register');
    Route::post('/register', 'store');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
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

// Course
Route::controller(CourseController::class)->group(function () {
    Route::get('/course/mentor', 'courseMentor')->name('course.mentor');
    Route::get('/course/mentor/{customer:name}', 'getCourseMentorCategory')->name('course.mentor.category');
});


/*  USER  */
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// Dashboard
Route::get('/dashboard/get-course-category', [CourseController::class, 'getCourseCategory'])->name('get.dashboard.course.category');
Route::get('/dashboard/get-mentor-popular', [DashboardController::class, 'getMentorPopular'])->name('get.dashboard.mentor.popular');
// Category
Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'dashboardCategory')->name('category');
});
// Mentor
Route::controller(MentorController::class)->group(function () {
    Route::get('/mentor', 'dashboardMentor')->name('mentor');
    Route::get('/get-mentor', 'getDashboardMentor')->name('get.mentor');
    Route::get('/mentor/{customer:name}', 'show')->name('mentor.show');
});

// Student Role
Route::group(['middleware' => ['auth']], function () {
    // Cart
    Route::group(['middleware' => ['checkRole:student']], function () {
        Route::controller(CartController::class)->group(function () {
            Route::post('/cart', 'store')->name('cart.store');
            Route::get('/get-cart', 'getCart')->name('get.cart');
        });
    });

    // Course Enroll
    Route::group(['middleware' => ['checkRole:student']], function () {
        Route::controller(CourseEnrollController::class)->group(function () {
            Route::post('/checkout/{course:title}/getDiscount', 'getDiscountCourse')->name('course.get.discount');
            Route::get('/checkout/{course:title}', 'getCheckoutCourse')->name('course.get.checkout');
            Route::post('/checkout/{course:title}', 'checkoutCourse')->name('course.checkout');
            Route::delete('/checkout/{courseEnroll:id}', 'destroy');
        });
    });
});
// Cart
