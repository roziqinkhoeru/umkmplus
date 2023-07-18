<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\WithdrawController;
use Symfony\Component\Routing\RouteCompiler;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MediaModuleController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\CourseEnrollController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\MentorRegistrationController;
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

// user
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/about', function () {
    return view('user.company.about', ['title' => 'Tentang Kami | UMKMPlus']);
});
Route::get('/contact', function () {
    return view('user.supports.contact', ['title' => 'Kontak Kami | UMKMPlus']);
});
Route::get('/terms', function () {
    return view('user.supports.terms', ['title' => 'Syarat da Ketentuan | UMKMPlus']);
});
Route::get('/faq', function () {
    return view('user.supports.faq', ['title' => 'FAQ | UMKMPlus']);
});
Route::get('/tutorial', function () {
    return view('user.supports.tutorial', ['title' => 'Tutorial | UMKMPlus']);
});

Route::get('/dashboard/search/{any}', function () {
    return view('admin.search', ['title' => 'Search | Dashboard UMKMPlus', 'active' => 'search']);
});

// admin
Route::get('/admin/reset-password', function () {
    return view('admin.auth.resetPassword', ['title' => 'Reset Password | Admin UMKMPlus']);
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

// Blog
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog.index');
    Route::get('/blog/data', 'getBlog')->name('blog.data');
    Route::get('/blog/{blog:slug}', 'show')->name('blog.show');
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

        Route::controller(DashboardController::class)->group(function () {
            Route::get('/profile', 'profile')->name('profile');
            Route::get('/profile/get-dashboard', 'getDashboard')->name('get.dashboard');
            Route::get('/profile/get-profile', 'getProfile')->name('get.profile');
            Route::put('/profile/update-profile', 'updateProfile')->name('update.profile');
            Route::put('/profile/update-photo-profile', 'updatePhotoProfile')->name('update.photo.profile');
            Route::get('/profile/get-courses', 'getCourseProfile')->name('get.profile.course');
            Route::get('/profile/get-transaction-history', 'getTransactionHistory')->name('get.profile.transaction.history');
            Route::put('/profile/change-password', 'changePassword')->name('profile.change.password');
        });

        // Course
        Route::controller(CourseEnrollController::class)->group(function () {
            Route::post('/checkout/{course:slug}/getDiscount', 'getDiscountCourse')->name('course.get.discount');
            Route::get('/checkout/{course:slug}', 'getCheckoutCourse')->name('course.get.checkout');
            Route::post('/checkout/{course:slug}', 'checkoutCourse')->name('course.checkout');
            Route::delete('/checkout/{courseEnroll:id}', 'destroy');
            Route::get('/course/playing/{courseEnroll:id}', 'coursePlaying')->name('course.playing');
            Route::get('/course/playing/{courseEnroll:id}/media', 'coursePlayingMedia')->name('course.playing.media');
            Route::get('/course/playing/{courseEnroll:id}/test', 'coursePlayingTest')->name('course.playing.test');
            Route::get('/course/playing/{courseEnroll:id}/test/finish', 'coursePlayingTestFinish')->name('course.playing.test');
            Route::get('/course/testimonial/{courseEnroll:id}', 'courseStudentTestimonial')->name('course.testimonial');
            Route::get('/course/certificate/{courseEnroll:id}', 'courseCertificate')->name('course.certificate');
        });

        // Testimonial
        Route::controller(TestimonialController::class)->group(function () {
            Route::post('/testimonial/{courseEnroll:id}', 'store')->name('testimonial.store');
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
            Route::get('/admin/profile', 'profile')->name('admin.profile');
            Route::put('/admin/profile/update', 'adminUpdateProfile')->name('admin.update.profile');
            Route::get('/admin/profile/edit-password', 'adminEditPassword')->name('admin.edit.password');
            Route::put('/admin/profile/change-password', 'adminChangePassword')->name('admin.change.password');
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
            Route::put('/admin/course/application/{course:slug}/reject', 'rejectApplication')->name('admin.course.application.reject');
            Route::get('/admin/course/application/{course:slug}/accept', 'editApprovalApplication')->name('admin.course.application.detail');
            Route::put('/admin/course/application/{course:slug}/accept', 'updateApprovalApplication')->name('admin.course.application.approval');
            Route::get('/admin/course/{course:slug}', 'adminShow')->name('admin.course.show');
        });
        // Student
        Route::controller(StudentController::class)->group(function () {
            Route::get('/admin/student', 'adminStudent')->name('admin.student');
            Route::get('/admin/student/{customer:id}', 'adminStudentShow')->name('admin.student.show');
        });
        // Testimonial
        Route::controller(TestimonialController::class)->group(function () {
            Route::get('/admin/testimonial', 'adminTestimonial')->name('admin.testimonial');
            Route::put('/admin/testimonial/{testimonial:id}', 'editStatusTestimonial')->name('admin.testimonial.status');
        });
        // Blog
        Route::controller(BlogController::class)->group(function () {
            Route::get('/admin/blog', 'adminBlog')->name('admin.blog');
            Route::get('/admin/blog/create', 'adminBlogCreate')->name('admin.blog.create');
            Route::get('/admin/blog/{blog:slug}', 'adminBlogShow')->name('admin.blog.show');
        });
        // Withdraw
        Route::controller(WithdrawController::class)->group(function () {
            Route::get('/admin/withdraw', 'adminWithdraw')->name('admin.withdraw');
            Route::get('/admin/withdraw/get', 'getAdminWithdraw')->name('get.admin.withdraw');
            Route::get('/admin/withdraw/{withdraw:id}', 'adminWithdrawEdit')->name('admin.withdraw.edit');
            Route::put('/admin/withdraw/{withdraw:id}', 'adminWithdrawUpdate')->name('admin.withdraw.update');
            Route::put('/admin/withdraw/{withdraw:id}/status', 'adminWithdrawUpdateStatus')->name('admin.withdraw.delete');
        });
    });
    /** MENTOR **/
    Route::group(['middleware' => ['checkRole:mentor']], function () {
        Route::controller(MentorController::class)->group(function () {
            Route::get('/mentor/dashboard', 'mentorDashboard')->name('mentor.dashboard');
            Route::get('/mentor/profile', 'mentorProfile')->name('mentor.profile');
            Route::get('/mentor/profile/edit', 'mentorEditProfile')->name('mentor.edit.profile');
            Route::put('/mentor/profile/update', 'mentorUpdateProfile')->name('mentor.update.profile');
            Route::get('/mentor/profile/edit-password', 'mentorEditPassword')->name('mentor.edit.password');
            Route::put('/mentor/profile/change-password', 'mentorChangePassword')->name('mentor.change.password');
        });
        Route::controller(DiscountController::class)->group(function () {
            Route::get('/mentor/discount', 'mentorDiscount')->name('mentor.discount');
            Route::get('/mentor/discount/create', 'create')->name('mentor.discount.create');
            Route::post('/mentor/discount', 'store')->name('mentor.discount.store');
            Route::put('/mentor/discount/{discount:id}/status', 'editStatusDiscount')->name('mentor.discount.status');
            Route::delete('/mentor/discount/{discount:id}/destroy', 'destroy')->name('mentor.discount.destroy');
            Route::get('/mentor/discount/{discount:id}', 'edit')->name('mentor.discount.edit');
            Route::put('/mentor/discount/{discount:id}', 'update')->name('mentor.discount.update');
        });
        // Course
        Route::controller(CourseController::class)->group(function () {
            Route::get('/mentor/course', 'mentorCourse')->name('mentor.course');
            Route::get('/mentor/course/create', 'mentorCourseCreate')->name('mentor.course.create');
            Route::post('/mentor/course', 'mentorCourseStore')->name('mentor.course.store');
            Route::get('/mentor/course/{course:slug}', 'mentorCourseShow')->name('mentor.course.show');
            Route::get('/mentor/course/{course:slug}/edit', 'mentorCourseEdit')->name('mentor.course.edit');
            Route::put('/mentor/course/{course:slug}', 'mentorCourseUpdate')->name('mentor.course.update');
            Route::delete('/mentor/course/{course:slug}', 'mentorCourseDestroy')->name('mentor.course.destroy');
        });
        // Module
        Route::controller(ModuleController::class)->group(function () {
            Route::get('/mentor/course/{course:slug}/module', 'mentorModule')->name('mentor.module');
            Route::get('/mentor/course/{course:slug}/module/get', 'getMentorModule')->name('get.mentor.module');
            Route::get('/mentor/course/{course:slug}/module/create', 'mentorModuleCreate')->name('mentor.module.create');
            Route::post('/mentor/course/{course:slug}/module', 'mentorModuleStore')->name('mentor.module.store');
            Route::get('/mentor/course/{course:slug}/module/{module:slug}/edit', 'mentorModuleEdit')->name('mentor.module.edit');
            Route::put('/mentor/course/{course:slug}/module/{module:slug}', 'mentorModuleUpdate')->name('mentor.module.update');
            Route::delete('/mentor/course/{course:slug}/module/{module:slug}', 'mentorModuleDestroy')->name('mentor.module.destroy');
        });
        // Media Module
        Route::controller(MediaModuleController::class)->group(function () {
            Route::get('/mentor/module/{module:slug}/media', 'mentorMediaModule')->name('mentor.media.module');
            Route::get('/mentor/module/{module:slug}/media/get', 'getMentorMediaModule')->name('get.mentor.media.module');
            Route::get('/mentor/module/{module:slug}/media/create', 'mentorMediaModuleCreate')->name('mentor.media.module.create');
            Route::post('/mentor/module/{module:slug}/media', 'mentorMediaModuleStore')->name('mentor.media.module.store');
            Route::get('/mentor/module/{module:slug}/media/{mediaModule:id}/edit', 'mentorMediaModuleEdit')->name('mentor.media.module.edit');
            Route::put('/mentor/module/{module:slug}/media/{mediaModule:id}', 'mentorMediaModuleUpdate')->name('mentor.media.module.update');
            Route::delete('/mentor/module/{module:slug}/media/{mediaModule:id}', 'mentorMediaModuleDestroy')->name('mentor.media.module.destroy');
        });
        // Student
        Route::controller(StudentController::class)->group(function () {
            Route::get('/mentor/student', 'mentorStudent')->name('mentor.student');
            Route::get('/mentor/un-student', 'mentorUncompletedStudent')->name('mentor.uncompleted.student');
            Route::get('/mentor/un-student/{courseEnroll:id}', 'mentorUncompletedStudentEdit')->name('mentor.uncompleted.student.edit');
            Route::put('/mentor/un-student/{courseEnroll:id}', 'mentorUncompletedStudentUpdate')->name('mentor.uncompleted.student.update');
        });
        // Blog
        Route::controller(BlogController::class)->group(function () {
            Route::get('/mentor/blog', 'mentorBlog')->name('mentor.blog');
            Route::get('/mentor/blog/create', 'mentorBlogCreate')->name('mentor.blog.create');
            Route::get('/mentor/blog/{blog:slug}', 'mentorBlogShow')->name('mentor.blog.show');
        });
        // Testimonial
        Route::controller(TestimonialController::class)->group(function () {
            Route::get('/mentor/testimonial/{course:slug}', 'mentorCourseTestimonial')->name('mentor.course.testimonial');
        });
        // Withdraw
        Route::controller(WithdrawController::class)->group(function () {
            Route::get('/mentor/withdraw', 'mentorWithdraw')->name('mentor.withdraw');
            Route::get('/mentor/withdraw/create', 'mentorWithdrawCreate')->name('mentor.withdraw.create');
            Route::post('/mentor/withdraw', 'mentorWithdrawStore')->name('mentor.withdraw.store');
        });
    });

    /** MENTOR & ADMIN **/
    Route::group(['middleware' => ['checkRole:mentor,admin']], function () {
        Route::controller(CourseController::class)->group(function () {
            Route::put('/admin/course/{course:slug}/status', 'editStatusCourse')->name('admin.course.status');
        });
        // Blog
        Route::controller(BlogController::class)->group(function () {
            Route::post('/admin/blog', 'blogStore')->name('admin.blog.store');
            Route::put('/admin/blog/{blog:slug}', 'blogUpdate')->name('admin.blog.update');
            Route::delete('/admin/blog/{blog:slug}', 'blogDestroy')->name('admin.blog.show');
            Route::put('/admin/blog/{blog:slug}/status', 'blogUpdateStatus')->name('admin.blog.update.status');
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
