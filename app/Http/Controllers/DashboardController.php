<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\Customer;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $testimonials = Testimonial::with('courseEnroll.student')->where('status', 'tampilkan')->limit(3)->get();
        if ($testimonials->isEmpty()) {
            $testimonials = null;
        }

        if (Auth::check()) {
            $countCart = Cart::countCart();
            $data =
                [
                    'title' => 'UMKM Plus',
                    'categories' => $categories,
                    'testimonials' => $testimonials,
                    'countCart' => $countCart,
                ];
        } else {

            $data =
                [
                    'title' => 'UMKM Plus',
                    'categories' => $categories,
                    'testimonials' => $testimonials
                ];
        }

        return view('user.home', $data);
    }


    public function getMentorPopular()
    {
        $mentorPopulars = Customer::dataCourseStudent()
            ->limit(4)
            ->get();
        foreach ($mentorPopulars as $mentorPopular) {
            $totalCourse = Customer::select('courses.id')->join('courses', 'courses.mentor_id', '=', 'customers.id')->where('customers.id', $mentorPopular->id)->count();
            $mentorPopular->total_course = $totalCourse;
        }

        return response()->json([
            'status' => 'success',
            'data' => $mentorPopulars
        ]);
    }

    public function profile()
    {
        $user = Auth::user()->customer;
        $profile = Customer::withCount(["studentCourseEnrolls as student_course_enrolls_count" => function ($query) {
            $query->whereIn("status", ["aktif", "selesai"]);
        }], 'carts')->where('id', $user->id)->first();
        $data = [
            'title' => 'Akun Saya | UMKMPlus',
            'active' => 'account',
            'profile' => $profile
        ];

        return view('user.profile.myAccount', $data);
    }

    public function getProfile()
    {
        $user = Auth::user();
        $profile = User::with('customer')->where('id', $user->id)->first();

        if ($user) {
            return ResponseFormatter::success($profile, 'Data profile berhasil diambil');
        }
        return ResponseFormatter::error(null, 'Data profile tidak ada', 404);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $customer = Customer::where('id', $user->id)->first();
        if ($customer->email == $request->email) {
            $rules = [
                'name' => 'required|string|max:255',
                'gender' => 'required',
                'phone' => 'required|numeric',
                'address' => 'required|string',
                'email' => 'required',
            ];
        } else {
            $rules = [
                'name' => 'required|string|max:255',
                'gender' => 'required',
                'phone' => 'required|numeric',
                'address' => 'required|string',
                'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            ];
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'error' => $validator->errors()->first(),
                ],
                "Gagal mengubah data profile",
                400
            );
        }
        try {
            DB::beginTransaction();
            $user->email = $request->email;
            $updateUser = $user->save();

            if (!$updateUser) {
                DB::rollBack();
                return ResponseFormatter::error(
                    [
                        'error' => 'Gagal mengubah data profile',
                    ],
                    'Gagal mengubah data profile',
                    400
                );
            }

            $updateCustomer = $customer->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'address' => $request->address
            ]);

            if (!$updateCustomer) {
                DB::rollBack();
                return ResponseFormatter::error(
                    [
                        'error' => 'Gagal mengubah data profile',
                    ],
                    'Gagal mengubah data profile',
                    400
                );
            }

            DB::commit();
            $profile = User::with('customer')->where('id', $user->id)->first();

            return ResponseFormatter::success(
                [
                    'profile' => $profile,
                ],
                'Berhasil mengubah data profile'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                [
                    'error' => $e->getMessage(),
                ],
                $e->getMessage(),
                400
            );
        }
    }

    public function getCourseProfile()
    {
        $user = Auth::user()->customer;
        $courseProfile = CourseEnroll::with('course', 'course.mentor:id,name', 'course.category')
        ->where('student_id', $user->id)
        ->whereIn('status', ['selesai', 'aktif'])
        ->get();

        if ($courseProfile) {
            return ResponseFormatter::success($courseProfile, 'Data course profile berhasil diambil');
        }
        return ResponseFormatter::error(null, 'Data course profile tidak ada', 404);
    }

    public function getTransactionHistory()
    {
        $user = Auth::user()->customer;
        $transactionHistory = CourseEnroll::with('course', 'course.mentor', 'course.category')->where('student_id', $user->id)->get();

        if ($transactionHistory) {
            return ResponseFormatter::success($transactionHistory, 'Data transaction history berhasil diambil');
        }
        return ResponseFormatter::error(null, 'Data transaction history tidak ada', 404);
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Form salah diisi
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => $validator->errors()->first(),
                    ],
                    "Gagal mengubah password",
                    400,
                )
                : back()->with(['error' => $validator->errors()]);
        }

        $user = User::find(Auth::user()->id);

        // Memeriksa kecocokan password lama
        if (Hash::check($request->old_password, $user->password)) {
            // Password lama cocok

            $user->password = Hash::make($request->password);
            $user->save();

            // Mengembalikan respon yang sesuai
            return $request->ajax()
                ? ResponseFormatter::success([
                    'message' => 'Password berhasil diubah',
                ], 'Password berhasil diubah')
                : back()->with(['success' => 'Password berhasil diubah']);
        } else {
            // Password lama tidak cocok

            // Mengembalikan respon dengan pesan kesalahan
            return $request->ajax()
                ? ResponseFormatter::error([
                    'error' => 'Password lama tidak cocok',
                ], 'Password lama tidak cocok', 400)
                : back()->with(['error' => 'Password lama tidak cocok']);
        }
    }
}
