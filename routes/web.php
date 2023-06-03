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
use App\Http\Controllers\StudentController;
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

Route::get('/admin/blog', function () {
    return view('admin.blog.index', ['title' => 'Blog | Admin UMKMPlus', 'active' => 'blog']);
});

// mentor
Route::get('/mentor/blog', function () {
    return view('mentor.blog.index', ['title' => 'Blog | Mentor UMKMPlus', 'active' => 'blog']);
});
Route::get('/mentor/blog/create', function () {
    return view('mentor.blog.create', ['title' => 'Create Blog | Mentor UMKMPlus', 'active' => 'blog']);
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
    Route::get('/refresh-csrf-token', 'refreshCsrfToken');
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

/*  USER  */
// Course
Route::controller(CourseController::class)->group(function () {
    Route::get('/course', 'index')->name('course.index');
    Route::get('/course/data', 'getCourse')->name('course.data');
    Route::get('/course/mentor', 'courseMentor')->name('course.mentor');
    Route::get('/course/mentor/{customer:slug}', 'getCourseMentor')->name('course.mentor.category');
    Route::get('/course/category', 'category')->name('category');
    Route::get('/course/category/{category:slug}', 'courseCategory')->name('course.category');
    Route::get('/course/category/{category:slug}/data', 'getCourseCategory')->name('course.category');
    Route::get('/course/{course:slug}', 'show')->name('course.show');
});

// Student Role
Route::group(['middleware' => ['auth']], function () {
    //** STUDENT **/
    // Cart
    Route::group(['middleware' => ['checkRole:student']], function () {
        Route::controller(CartController::class)->group(function () {
            Route::get('/cart', 'index')->name('cart.index');
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

        Route::controller(DashboardController::class)->group(function () {
            Route::get('/profile', 'profile')->name('profile');
            Route::get('/profile/get-profile', 'getProfile')->name('get.profile');
            Route::put('/profile/update-profile', 'updateProfile')->name('update.profile');
            Route::get('/profile/get-courses', 'getCourseProfile')->name('get.profile.course');
            Route::get('/profile/get-transaction-history', 'getTransactionHistory')->name('get.profile.transaction.history');
            Route::put('/profile/change-password', 'changePassword')->name('profile.change.password');
        });

        // Course
        Route::controller(CourseEnrollController::class)->group(function () {
            Route::get('/course/playing/{courseEnroll:id}', 'coursePlaying')->name('course.playing');
            Route::get('/course/playing/{courseEnroll:id}/media', 'coursePlayingMedia')->name('course.playing.media');
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
    /** ADMIN **/
    Route::group(['middleware' => ['checkRole:admin']], function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/admin', 'index')->name('admin.dashboard');
            Route::get('/admin/nameAdmin', 'profile')->name('admin.profile');
        });
        // Mentor
        Route::controller(MentorController::class)->group(function () {
            Route::get('/admin/mentor', 'adminMentor')->name('admin.mentor');
            Route::get('/admin/mentor/application', 'application')->name('admin.mentor.application');
            Route::get('/admin/mentor/{customer:slug}', 'adminMentorShow')->name('admin.mentor.show');
            Route::put('/admin/mentor/{customer:slug}', 'editStatusMentor')->name('admin.mentor.nonaktif');
            Route::get('/admin/mentor/registration/{mentorRegistration:id}', 'createAccountMentor')->name('admin.mentor.registration.account');
            Route::post('/admin/mentor/registration/{mentorRegistration:id}', 'StoreAccountMentor')->name('admin.mentor.registration.store');
            Route::put('/admin/mentor/registration/{mentorRegistration:id}/rejected', 'rejectedMentor')->name('admin.mentor.registration.rejected');
        });
        // Course
        Route::controller(CourseController::class)->group(function () {
            Route::get('/admin/course', 'adminCourse')->name('admin.course');
            Route::get('/admin/course/application', 'application')->name('admin.course.application');
            Route::get('/admin/course/application/{course:slug}', 'applicationDetail')->name('admin.course.application.detail');
            Route::put('/admin/course/application/{course:slug}', 'approvalApplication')->name('admin.course.application.approval');
            Route::get('/admin/course/{course:slug}', 'adminShow')->name('admin.course.show');
        });
        // Student
        Route::controller(StudentController::class)->group(function () {
            Route::get('/admin/student', 'adminStudent')->name('admin.student');
            Route::get('/admin/student/{customer:id}', 'adminStudentShow')->name('admin.student.show');
        });
    });
    /** MENTOR **/
    Route::group(['middleware' => ['checkRole:mentor']], function () {
        Route::controller(MentorController::class)->group(function () {
            Route::get('/mentor/dashboard', 'mentorDashboard')->name('mentor.dashboard');
        });
        Route::controller(CourseController::class)->group(function () {
            Route::get('/mentor/course', 'mentorCourse')->name('mentor.course');
            Route::get('/mentor/course/create', 'mentorCourseCreate')->name('mentor.course.create');
            Route::get('/mentor/course/{course:slug}', 'mentorCourseShow')->name('mentor.course.show');
        });
        Route::controller(StudentController::class)->group(function () {
            Route::get('/mentor/student', 'mentorStudent')->name('mentor.student');
        });
    });

    /** MENTOR & ADMIN **/
    Route::group(['middleware' => ['checkRole:mentor,admin']], function () {
        Route::controller(CourseController::class)->group(function () {
            Route::put('/admin/course/{course:slug}/status', 'editStatusCourse')->name('admin.course.status');
        });
    });
});


// Dashboard
// Category
Route::get('/dashboard/get-course-category', [CourseController::class, 'getCourseCategoryDashboard'])->name('get.dashboard.course.category');
Route::get('/dashboard/get-mentor-popular', [DashboardController::class, 'getMentorPopular'])->name('get.dashboard.mentor.popular');

// Mentor
Route::middleware(['guest'])->group(function () {
    Route::controller(MentorRegistrationController::class)->group(function () {
        Route::get('/mentor/register', 'register')->name('mentor.register');
        Route::post('/mentor/register', 'storeRegister')->name('mentor.register');
    });
});

Route::controller(MentorController::class)->group(function () {
    Route::get('/mentor', 'dashboardMentor')->name('mentor');
    Route::get('/get-mentor', 'getDashboardMentor')->name('get.mentor');
    Route::get('/mentor/{customer:slug}', 'show')->name('mentor.show');
});
