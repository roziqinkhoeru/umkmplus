<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Blog;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Support\Str;
use App\Models\CourseEnroll;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $countStudent = User::leftJoin('role_users', 'role_users.role_id', '=', 'users.id')->where('role_users.role_id', '3')->count();
        $countMentor = User::leftJoin('role_users', 'role_users.role_id', '=', 'users.id')->where('role_users.role_id', '2')->count();
        $countCourse = Course::count();
        $countBlog = Blog::where('user_id', $user->id)->count();
        $countCourseCategories = Category::withCount(['courses'])->get();

        // Array month
        $bulan = range(1, 12);
        // revenue mentor per year
        $revenue = CourseEnroll::select(DB::raw('month(started_at) as month'), DB::raw('SUM(total_price) as total'))
            ->with('course')
            ->whereIn('status', ['aktif', 'selesai'])
            ->whereYear('started_at', date("Y")) // Menambahkan kondisi untuk membatasi hanya tahun sekarang
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');
        $revenueYear = $revenue->sum('total');
        // Membuat array hasil penghasilan
        $revenueMonth = [];
        foreach ($bulan as $bln) {
            $total = 0;
            if (isset($revenue[$bln])) {
                $total = $revenue[$bln]->total * 0.2;
            }
            $revenueMonth[$bln] = $total;
        }

        $data = [
            'title' => 'Dashboard Admin | Admin UMKMPlus',
            'active' => 'dashboard',
            'countStudent' => $countStudent,
            'countMentor' => $countMentor,
            'countCourse' => $countCourse,
            'countBlog' => $countBlog,
            'countCourseCategories' => $countCourseCategories,
            'revenueYear' => $revenueYear * 0.2,
            'revenueMonth' => $revenueMonth,
        ];

        return view('admin.dashboard', $data);
    }

    public function profile()
    {
        $admin = User::with('customer')->where('customer_id', Auth::user()->customer->id)->first();
        $data = [
            'title' => 'Profile Saya | Admin UMKMPlus',
            'active' => 'profile',
            'admin' => $admin,
        ];

        return view('admin.profile.index', $data);
    }


    public function adminUpdateProfile(Request $request)
    {
        $user = Auth::user();
        $admin = $user->customer;
        try {
            DB::beginTransaction();

            $rules = [
                'name' => 'required|min:3',
                'username' => 'required|min:3|max:25|unique:users,username,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'required|numeric',
                'gender' => 'required',
                'address' => 'required|min:3',
                'dob' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                // Form salah diisi
                return $request->ajax()
                    ? ResponseFormatter::error(
                        [
                            'error' => $validator->errors()->first(),
                        ],
                        'Harap isi form dengan benar',
                        400,
                    )
                    : back()->with(['error' => $validator->errors()]);
            }

            $dob = Carbon::createFromFormat('d/m/Y', $request->dob)->toDateString();

            // update customer
            $updateCustomer = $admin->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
                'dob' => $dob,
            ]);

            if (!$updateCustomer) {
                throw new Exception('Gagal memperbarui data admin.');
            }

            // update user
            $updateUser = User::whereId($user->id)->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);

            if (!$updateUser) {
                throw new Exception('Gagal memperbarui data user.');
            } else {
                DB::commit();
                return $request->ajax()
                    ? ResponseFormatter::success(
                        [
                            'redirect' => redirect('/admin/profile')->getTargetUrl(),
                        ],
                        'Update profil berhasil',
                    ) : redirect('/admin/profile')->with('success', 'Update profil berhasil');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => $e->getMessage(),
                    ],
                    'Update profil gagal',
                    400,
                ) : back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function adminEditPassword()
    {
        $admin = User::with('customer')->where('customer_id', Auth::user()->customer->id)->first();
        $data = [
            'title' => 'Edit Password | Admin UMKMPlus',
            'active' => 'profile',
            'admin' => $admin,
        ];

        return view('admin.profile.editPassword', $data);
    }

    public function adminChangePassword(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'old_password' => 'required',
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
                    'Harap isi form dengan benar',
                    400,
                )
                : back()->with(['error' => $validator->errors()]);
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => 'Password lama tidak sesuai',
                    ],
                    'Password lama tidak sesuai',
                    400,
                )
                : back()->with(['error' => 'Password lama tidak sesuai']);
        }

        $update = User::whereId($user->id)->update([
            'password' => Hash::make($request->password),
        ]);

        if ($update) {
            return $request->ajax()
                ? ResponseFormatter::success(
                    [
                        'redirect' => redirect('/admin/profile')->getTargetUrl(),
                    ],
                    'Update password berhasil',
                ) : redirect('/admin/profile')->with('success', 'Update password berhasil');
        }

        return $request->ajax()
            ? ResponseFormatter::error(
                null,
                'Update password gagal',
                500
            ) : back()->with(['error' => 'Update password gagal']);
    }
}
