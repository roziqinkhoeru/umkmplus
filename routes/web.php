<?php

use App\Http\Controllers\AdminController;
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
use App\Http\Controllers\MentorRegistrationController;
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
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/blog', function () {
    return view('user.blog.index', ['title' => 'Blog | UMKMPlus']);
});
Route::get('/blog/blogName', function () {
    return view('user.blog.detail', ['title' => '_blogName_ | UMKMPlus']);
});
Route::get('/join-mentor', function () {
    return view('user.mentors.join', ['title' => 'Become Our Mentor | UMKMPlus']);
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
    Route::get('/course/mentor/{customer:slug}', 'getCourseMentor')->name('course.mentor.category');
    Route::get('/course/category', 'category')->name('category');
    Route::get('/course/category/{category:slug}', 'courseCategory')->name('course.category');
    Route::get('/course/category/{category:slug}/data', 'getCourseCategory')->name('course.category');
    Route::get('/course/{course:slug}', 'show')->name('course.show');
});


/*  USER  */
// Dashboard
Route::get('/dashboard/get-course-category', [CourseController::class, 'getCourseCategoryDashboard'])->name('get.dashboard.course.category');
Route::get('/dashboard/get-mentor-popular', [DashboardController::class, 'getMentorPopular'])->name('get.dashboard.mentor.popular');
// Category
// Mentor
Route::group(['middleware' => ['auth']], function () {
    // Register Mentor
    Route::group(['middleware' => ['checkRole:student']], function () {
        Route::controller(MentorRegistrationController::class)->group(function () {
            Route::get('/mentor/register', 'register')->name('mentor.register');
            Route::post('/mentor/register', 'storeRegister')->name('mentor.register');
        });
    });
});
Route::controller(MentorController::class)->group(function () {
    Route::get('/mentor', 'dashboardMentor')->name('mentor');
    Route::get('/get-mentor', 'getDashboardMentor')->name('get.mentor');
    Route::get('/mentor/{customer:slug}', 'show')->name('mentor.show');
});

// Student Role
Route::group(['middleware' => ['auth']], function () {
    // Cart
    Route::group(['middleware' => ['checkRole:student']], function () {
        Route::controller(CartController::class)->group(function () {
            Route::post('/cart', 'store')->name('cart.store');
            Route::get('/get-cart', 'getCart')->name('get.cart');
            Route::delete('/cart/{cart:id}', 'destroy')->name('cart.destroy');
        });

        // Course Enroll
        Route::controller(CourseEnrollController::class)->group(function () {
            Route::post('/checkout/{course:slug}/getDiscount', 'getDiscountCourse')->name('course.get.discount');
            Route::get('/checkout/{course:slug}', 'getCheckoutCourse')->name('course.get.checkout');
            Route::post('/checkout/{course:slug}', 'checkoutCourse')->name('course.checkout');
            Route::delete('/checkout/{courseEnroll:id}', 'destroy');
        });
    });
});
// Cart

// ADMIN

// auth
Route::controller(LoginController::class)->group(function () {
    Route::get('/admin/login', 'adminLogin')->name('admin.login');
    Route::post('/admin/login', 'adminAuthenticate');
});

Route::controller(PasswordResetLinkController::class)->group(function () {
    Route::get('/admin/forgot-password', 'adminCreate')->name('admin.password.forgot');
    Route::post('/admin/forgot-password', 'adminStore')->name('admin.forgotPassword');
});

// main
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['checkRole:admin']], function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/admin', 'index')->name('admin.dashboard');
        });
        // Mentor
        Route::controller(MentorController::class)->group(function () {
            Route::get('/admin/mentor', 'adminMentor')->name('admin.mentor');
            Route::get('/admin/mentor/registration', 'listRegistration')->name('admin.mentor.list');
            Route::get('/admin/mentor/create', 'adminCreateMentor')->name('admin.mentor.create');
            Route::post('/admin/mentor/create', 'adminStoreMentor')->name('admin.mentor.store');
            Route::get('/admin/mentor/{customer:slug}', 'adminMentorShow')->name('admin.mentor.show');
            Route::put('/admin/mentor/{customer:slug}', 'adminNonaktifMentor')->name('admin.mentor.nonaktif');
        });
    });
});
