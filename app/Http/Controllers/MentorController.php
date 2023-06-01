<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Course;
use App\Models\Customer;
use App\Models\MentorRegistration;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MentorController extends Controller
{
    public function dashboardMentor()
    {
        $data =
            [
                'title' => 'Mentor | UMKMPlus',
            ];

        return view('user.mentors.index', $data);
    }

    public function getDashboardMentor(Request $request)
    {
        if ($request->name == '') {
            $mentors = Customer::dataCourseStudent()
                ->limit(8)
                ->get();
            foreach ($mentors as $mentor) {
                $totalCourse = Customer::select('courses.id')->join('courses', 'courses.mentor_id', '=', 'customers.id')->where('customers.id', $mentor->id)->count();
                $mentor->total_course = $totalCourse;
            }
        } else {
            $mentors = Customer::dataCourseStudent()
                ->where('customers.name', 'like', '%' . $request->name . '%')
                ->limit(8)
                ->get();
            foreach ($mentors as $mentor) {
                $totalCourse = Customer::select('courses.id')->join('courses', 'courses.mentor_id', '=', 'customers.id')->where('customers.id', $mentor->id)->count();
                $mentor->total_course = $totalCourse;
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $mentors,
            'countMentor' => $mentors->count(),
        ]);
    }

    public function show(Customer $customer)
    {
        $mentor = Customer::join('users', 'users.customer_id', '=', 'customers.id')
            ->join('role_users', 'role_users.user_id', '=', 'users.id')->whereName($customer->name)->first();
        if ($mentor->role_id != '2') {
            return abort(404);
        }
        $countCourse = Course::where('mentor_id', $mentor->id)->count();
        $countStudent = Customer::countStudent($mentor->id);

        $mentor->joinDate = date_format($mentor->created_at, 'd F Y');
        $data =
            [
                'title' => 'Mentor ' . $mentor->name . ' | UMKMPlus',
                'mentor' => $mentor,
                'countCourse' => $countCourse,
                'countStudent' => $countStudent,
            ];

        return view('user.mentors.detail', $data);
    }

    public function adminMentor()
    {
        $mentors = Customer::mentor()->get()->load('mentorCourses', 'mentorCourses.category')->map(function ($mentor) {
            $mentor->mentorCourses = $mentor->mentorCourses->take(3); // Mengambil 5 mentorCourses
            return $mentor;
        });;
        $data = [
            'title' => 'Mentor | Admin UMKMPlus',
            'active' => 'mentor',
            'mentors' => $mentors
        ];

        return view('admin.mentor.index', $data);
    }

    public function adminMentorShow(Customer $customer)
    {
        $data =
            [
                'title' => 'Detail Mentor | Admin UMKMPlus',
                'active' => 'mentor',
                'mentor' => $customer
            ];
        dd($customer);

        return view('admin.mentor.show', $data);
    }

    public function adminNonaktifMentor(Request $request, Customer $customer)
    {
        $update = $customer->update([
            'status' => $request->status
        ]);
        if ($update) {
            return ResponseFormatter::success(
                $customer,
                'success nonaktif mentor'
            );
        }

        return ResponseFormatter::error(
            null,
            'Gagal menonaktifkan mentor',
            500
        );
    }

    public function listRegistration()
    {
        $mentors = MentorRegistration::all();
        $data = [
            'title' => 'Pendaftaran Mentor | Admin UMKMPlus',
            'active' => 'mentor',
            'mentors' => $mentors
        ];

        return view('admin.mentor.listRegistration', $data);
    }

    public function createAccountMentor(MentorRegistration $mentorRegistration)
    {
        $data = [
            'title' => 'Buat Akun Mentor | Admin UMKMPlus',
            'active' => 'mentor',
            'mentorRegistration' => $mentorRegistration
        ];

        return view('admin.mentor.create', $data);
    }

    public function StoreAccountMentor(Request $request, MentorRegistration $mentorRegistration)
    {
        try {
            DB::beginTransaction();

            $rules = [
                'name' => 'required|min:3',
                'phone' => 'required|numeric',
                'address' => 'required|min:3',
                'username' => 'required|min:3|max:25|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
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

            $mentorRegistration->update([
                'status' => 'diterima'
            ]);

            // create customer
            $customer = Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'file_cv' => $request->file_cv,
                'status' => 1,
            ]);

            if (!$customer) {
                DB::rollBack();
            }

            // create user
            $user = User::create([
                'username' => $request->username,
                'customer_id' => $customer->id,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Hash::make() untuk mengenkripsi password
            ]);

            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => 2,
            ]);

            if (!$user) {
                DB::rollBack();
            } else {
                DB::commit();
                return $request->ajax()
                    ? ResponseFormatter::success(
                        [
                            'redirect' => redirect('/admin/mentor')->getTargetUrl(),
                        ],
                        'Tambah mentor berhasil',
                    ) : redirect('/admin/mentor')->with('success', 'Tambah mentor berhasil');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => $e->getMessage(),
                    ],
                    'Tambah mentor gagal',
                    400,
                ) : back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function rejectedMentor(MentorRegistration $mentorRegistration)
    {
        $update = $mentorRegistration->update([
            'status' => 'ditolak'
        ]);
        if ($update) {
            return ResponseFormatter::success(
                $mentorRegistration,
                'Berhasil menolak mentor'
            );
        }

        return ResponseFormatter::error(
            null,
            'Gagal menolak mentor',
            500
        );
    }
}
