<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Blog;
use App\Models\User;
use App\Models\Course;
use App\Models\Mentor;
use App\Models\Category;
use App\Models\Customer;
use App\Models\RoleUser;
use App\Models\Specialist;
use Illuminate\Support\Str;
use App\Models\CourseEnroll;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\CustomerSpecialist;
use App\Models\MentorRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MentorController extends Controller
{

    /** ROLE USER **/
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
            $mentors = Customer::mentor()
                ->with(['dataMentor', 'specialists:name'])
                ->withCount('mentorCourses')
                ->get();
            foreach ($mentors as $mentor) {
                $countStudent = Customer::countStudent($mentor->id);
                $mentor->count_student = $countStudent;
            }
        } else {
            $mentors = Customer::mentor()
                ->with(['dataMentor', 'specialists:name'])
                ->withCount('mentorCourses')
                ->where('name', 'like', '%' . $request->name . '%')
                ->get();
            foreach ($mentors as $mentor) {
                $countStudent = Customer::countStudent($mentor->id);
                $mentor->count_student = $countStudent;
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
        $mentor = Customer::with('dataMentor')->join('users', 'users.customer_id', '=', 'customers.id')
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

    /** ROLE ADMIN **/
    public function adminMentor()
    {
        $mentors = Customer::mentor()->get()->load('mentorCourses', 'mentorCourses.category', 'dataMentor')->map(function ($mentor) {
            $mentor->mentorCourses = $mentor->mentorCourses->take(3); // Mengambil 5 mentorCourses
            return $mentor;
        });
        $data = [
            'title' => 'Mentor | Admin UMKMPlus',
            'active' => 'mentor',
            'mentors' => $mentors
        ];

        return view('admin.mentor.index', $data);
    }

    public function adminMentorShow(Customer $customer)
    {
        $customer->load('mentorCourses', 'mentorCourses.category', 'user');
        $data =
            [
                'title' => 'Detail Mentor | Admin UMKMPlus',
                'active' => 'mentor',
                'mentor' => $customer
            ];

        return view('admin.mentor.show', $data);
    }

    public function editStatusMentor(Request $request, Customer $customer)
    {
        $mentor = Mentor::where('customer_id', $customer->id)->first();
        $update = $mentor->update([
            'status' => $request->status
        ]);
        if ($update) {
            return ResponseFormatter::success(
                $customer,
                'Berhasil mengubah status mentor'
            );
        }

        return ResponseFormatter::error(
            null,
            'Gagal mengubah status mentor',
            500
        );
    }

    public function application()
    {
        $mentors = MentorRegistration::get();
        $data = [
            'title' => 'Pendaftaran Mentor | Admin UMKMPlus',
            'active' => 'application',
            'mentors' => $mentors
        ];

        return view('admin.mentor.application', $data);
    }

    public function createAccountMentor(MentorRegistration $mentorRegistration)
    {
        $categories = Category::get();
        $data = [
            'title' => 'Buat Akun Mentor | Admin UMKMPlus',
            'active' => 'mentor',
            'mentorRegistration' => $mentorRegistration,
            'categories' => $categories
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
                'job' => 'required',
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
                'slug' => Str::lower(Str::slug($request->name, '-')),
                'phone' => $request->phone,
                'address' => $request->address,
                'job' => $request->job,
                'profile_picture' => 'profile/profile-placeholder.png', // default profile photo
                'dob' => null
            ]);

            if (!$customer) {
                throw new Exception('Gagal Menambahkan Mentor.');
            }

            // create data mentor
            $mentor = Mentor::create([
                'customer_id' => $customer->id,
                'file_cv' => $mentorRegistration->file_cv,
                'status' => 1,
            ]);

            if (!$mentor) {
                throw new Exception('Gagal Menambahkan Mentor.');
            }
            // Create Specialist
            $specialist = Specialist::whereName($request->specialist)->first();

            $specialistCreate = CustomerSpecialist::create([
                'customer_id' => $customer->id,
                'specialist_id' => $specialist->id,
            ]);

            if (!$specialistCreate) {
                throw new Exception('Gagal Menambahkan Mentor.');
            }

            // create user
            $user = User::create([
                'username' => Str::lower($request->username),
                'customer_id' => $customer->id,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Hash::make() untuk mengenkripsi password
            ]);

            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => 2,
            ]);

            if (!$user) {
                throw new Exception('Gagal Menambahkan Mentor.');
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

    /* ROLE MENTOR */
    public function mentorDashboard()
    {
        $user = Auth::user();
        $countStudent = CourseEnroll::select(DB::raw('COUNT(*) as countStudent'))->with('course')->whereHas('course', function ($query) use ($user) {
            $query->where('mentor_id', $user->customer->id);
        })
            ->groupBy('student_id')
            ->get();
        $countStudent = count($countStudent);
        $countCourse = Course::where('mentor_id', $user->customer->id)->count();
        $countBlog = Blog::where('user_id', $user->id)->count();
        $countCourseCategories = Category::withCount(['courses' => function ($query) use ($user) {
            $query->where('mentor_id', $user->customer->id);
        }])->get();

        // Array month
        $bulan = range(1, 12);
        // revenue mentor per year
        $revenue = CourseEnroll::select(DB::raw('month(started_at) as month'), DB::raw('SUM(total_price) as total'))->with('course')->whereHas('course', function ($query) use ($user) {
            $query->where('mentor_id', $user->customer->id);
        })
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
                $total = $revenue[$bln]->total * 0.8;
            }
            $revenueMonth[$bln] = $total;
        }
        $data = [
            'title' => 'Dashboard Mentor | Mentor UMKMPlus',
            'active' => 'dashboard',
            'countStudent' => $countStudent,
            'countCourse' => $countCourse,
            'countBlog' => $countBlog,
            'countCourseCategories' => $countCourseCategories,
            'revenueYear' => $revenueYear * 0.8,
            'revenueMonth' => $revenueMonth,
        ];
        // dd($data);

        return view('mentor.dashboard', $data);
    }

    public function mentorProfile()
    {
        $user = Auth::user()->customer;
        $mentor = Customer::with('mentorCourses', 'mentorCourses.category', 'user', 'dataMentor')->where('id', $user->id)->first();
        $data = [
            'title' => 'Profil Saya | Mentor UMKMPlus',
            'active' => 'profile',
            'mentor' => $mentor
        ];

        return view('mentor.profile.myAccount', $data);
    }

    public function mentorEditProfile()
    {
        $user = Auth::user();
        $mentor = Customer::with('dataMentor')->where('id', $user->id)->first();
        $categories = Category::get();
        $data = [
            'title' => 'Edit Profil | Mentor UMKMPlus',
            'active' => 'profile',
            'mentor' => $mentor,
            'categories' => $categories
        ];

        return view('mentor.profile.edit', $data);
    }

    public function mentorUpdateProfile(Request $request)
    {
        $user = Auth::user();
        $customer = $user->customer;
        // dd($request->all());
        try {
            DB::beginTransaction();

            $rules = [
                'name' => 'required|min:3',
                'phone' => 'required|numeric',
                'dob' => 'required',
                'gender' => 'required',
                'address' => 'required|min:3',
                'job' => 'required',
                'username' => 'required|min:3|max:25|unique:users,username,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
                'about' => 'required|min:3',
                'profilePicture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
            $updateCustomer = $customer->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'phone' => $request->phone,
                'dob' => $dob,
                'gender' => $request->gender,
                'address' => $request->address,
                'job' => $request->job,
            ]);

            if (!$updateCustomer) {
                throw new Exception('Gagal memperbarui data profil.');
            }
            if ($request->profilePicture) {
                # code...
                // check if photo profile is default
                if ($customer->profile_picture != 'profile/profile-placeholder.png' && $customer->profile_picture != 'profile/mentor-1.jpg') {
                    // Delete file photo profile before
                    $exists = Storage::disk('public')->exists($customer->profile_picture);
                    if ($exists) {
                        Storage::disk('public')->delete($customer->profile_picture);
                    }
                }
                $profile_picture = $request->file('profilePicture');
                $profile_picture_path = $profile_picture->store('profile', 'public');

                $updatePhotoProfile = $customer->update([
                    'profile_picture' => $profile_picture_path,
                ]);

                if (!$updatePhotoProfile) {
                    throw new Exception('Gagal memperbarui data foto profil.');
                }
            }

            // update data mentor
            $updateMentor = Mentor::whereCustomerId($customer->id)->update([
                'file_cv' => $request->file_cv,
                'about' => $request->about,
            ]);

            if (!$updateMentor) {
                throw new Exception('Gagal memperbarui data profil.');
            }

            // update Specialist
            $specialist = Specialist::whereName($request->specialist)->first();
            $specialistCustomer = CustomerSpecialist::whereCustomerId($customer->id)->first();
            if ($specialistCustomer) {
                $specialistUpdate = CustomerSpecialist::whereCustomerId($customer->id)->update([
                    'specialist_id' => $specialist->id,
                ]);
            } else {
                $specialistUpdate = CustomerSpecialist::create([
                    'customer_id' => $customer->id,
                    'specialist_id' => $specialist->id,
                ]);
            }

            if (!$specialistUpdate) {
                throw new Exception('Gagal memperbarui data spesialis.');
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
                            'redirect' => redirect('/mentor/profile')->getTargetUrl(),
                        ],
                        'Update profil mentor berhasil',
                    ) : redirect('/mentor/profile')->with('success', 'Update profil mentor berhasil');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            return $request->ajax()
                ? ResponseFormatter::error(
                    [
                        'error' => $e->getMessage(),
                    ],
                    'Update profil mentor gagal',
                    400,
                ) : back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function mentorEditPassword()
    {
        $data = [
            'title' => 'Edit Password | Mentor UMKMPlus',
            'active' => 'profile',
        ];

        return view('mentor.profile.editPassword', $data);
    }

    public function mentorChangePassword(Request $request)
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
                        'redirect' => redirect('/mentor/profile')->getTargetUrl(),
                    ],
                    'Update password berhasil',
                ) : redirect('/mentor/profile')->with('success', 'Update password berhasil');
        }

        return $request->ajax()
            ? ResponseFormatter::error(
                null,
                'Update password gagal',
                500
            ) : back()->with(['error' => 'Update password gagal']);
    }
}
