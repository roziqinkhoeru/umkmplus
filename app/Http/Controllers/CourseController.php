<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Course;
use App\Models\Customer;
use App\Models\MediaModule;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $categories = Category::all();
        $data = [
            'title' => 'Kelas | UMKMPlus',
            'categories' => $categories,
        ];

        return view('user.courses.index', $data);
    }

    public function getCourse(Request $request)
    {
        $courses = Course::query()
            ->with('mentor', 'category')
            ->withCount('modules', 'courseEnrolls')
            ->where('status', 'aktif')
            ->when($request->search, function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->category, function ($query) use ($request) {
                $query->whereHas('category', function ($query) use ($request) {
                    $query->where('slug', $request->category);
                });
            })
            ->when($request->sort, function ($query) use ($request) {
                switch ($request->sort) {
                    case 'newRelease':
                        $query->orderBy('created_at', 'desc');
                        break;
                    case 'promotion':
                        $query->where('discount', '!=', 0)->orderBy('discount', 'desc');
                        break;
                    case 'popular':
                        $query->orderBy('course_enrolls_count', 'desc');
                        break;
                    case 'cheapestCourse':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'expensiveCourse':
                        $query->orderBy('price', 'desc');
                        break;
                    case 'freeCourse':
                        $query->where('price', 0);
                        break;
                }
            })
            ->get();



        return response()->json([
            'status' => 'success',
            'data' => $courses,
            'courseCount' => $courses->count()
        ]);
    }
    public function courseMentor()
    {
        $userID = Auth::user()->id;
        $courses = Course::with('category')->where('mentor_id', $userID)->get();

        $data =
            [
                'title' => 'Kelas Saya | UMKM Plus',
                'courses' => $courses,
            ];

        return view('user.mentor.index', $data);
    }

    public function getCourseCategoryDashboard(Request $request)
    {
        $courses = Course::query();
        $courses->dataMentorCategory()
            ->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        $courses = $courses->limit(4)
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => $courses
        ]);
    }


    public function getCourseMentor(Customer $customer)
    {
        $courses = Course::dataMentorCategory()
            ->whereMentorId($customer->id)
            ->get();

        return ResponseFormatter::success(
            $courses,
            'Data list kelas berhasil diambil'
        );
    }

    public function category()
    {
        $categories = Category::all();

        $data = [
            'title' => 'Kategori Kelas | UMKMPlus',
            'categories' => $categories
        ];

        return view('user.courses.category', $data);
    }

    public function courseCategory(Category $category)
    {
        $data = [
            'title' => 'Kelas ' . $category->name . ' | UMKMPlus',
            'category' => $category
        ];
        return view('user.courses.indexCategory', $data);
    }

    public function getCourseCategory(Request $request, Category $category)
    {
        $courses = Course::query()
            ->with('mentor', 'category')
            ->withCount('modules', 'courseEnrolls')
            ->where('status', 'aktif')
            ->where('title', 'LIKE', '%' . $request->searchCourse . '%')
            ->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category->slug);
            })
            ->when($request->sort, function ($query) use ($request) {
                switch ($request->sort) {
                    case 'newRelease':
                        $query->orderBy('created_at', 'desc');
                        break;
                    case 'promotion':
                        $query->where('discount', '!=', 0)->orderBy('discount', 'desc');
                        break;
                    case 'popular':
                        $query->orderBy('course_enrolls_count', 'desc');
                        break;
                    case 'cheapestCourse':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'expensiveCourse':
                        $query->orderBy('price', 'desc');
                        break;
                    case 'freeCourse':
                        $query->where('price', 0);
                        break;
                }
            })
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $courses,
            'courseCount' => $courses->count()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        if ($course->status == 'nonaktif' || $course->status == 'pending') {
            return abort(404);
        }
        $course->load('mentor', 'modules', 'modules.mediaModules', 'courseEnrolls')->loadCount('modules');
        $countMediaModule = MediaModule::leftJoin('modules', 'media_modules.module_id', '=', 'modules.id')->where('course_id', $course->id)->count();
        $countCourse = Course::where('mentor_id', $course->mentor_id)->count();
        $countStudent = Customer::countStudent($course->mentor_id);
        if (Auth::check()) {
            $cartCourse = Cart::where('student_id', auth()->user()->customer_id)->where('course_id', $course->id)->first();
        }
        if (Auth::check()) {
            $courseEnroll = $course->courseEnrolls()->where('student_id', Auth::user()->id)->first();
        }
        $countMentor = [
            "countCourse" => $countCourse,
            "countStudent" => $countStudent
        ];
        $data =
            [
                'title' => $course->title . ' | UMKM Plus',
                'course' => $course,
                'countMediaModule' => $countMediaModule,
                'countMentor' => $countMentor,
                'courseEnroll' => $courseEnroll ?? null,
                'cartCourse' => $cartCourse->id ?? null
            ];

        return view('user.courses.detail', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        Course::destroy($course->id);

        return redirect()->route('courses.index')->with('success', 'Kelas berhasil dihapus');
    }

    public function adminCourse()
    {
        $courses = Course::select('title', 'mentor_id', 'category_id', 'price', 'status', 'slug')
            ->where('status', '=', 'aktif')
            ->orWhere('status', '=', 'nonaktif')
            ->with('category:id,name', 'mentor:id,name')
            ->get();

        $data =
            [
                'title' => 'Kelas | Admin UMKM Plus',
                'active' => 'course',
                'courses' => $courses
            ];

        return view('admin.courses.index', $data);
    }

    public function editStatusCourse(Request $request, Course $course)
    {
        $update = $course->update([
            'status' => $request->status
        ]);
        if ($update) {
            return ResponseFormatter::success(
                $course,
                'Berhasil mengubah status kelas'
            );
        }

        return ResponseFormatter::error(
            null,
            'Gagal mengubah status kelas',
            500
        );
    }


    public function application()
    {
        $courses = Course::select('title', 'mentor_id', 'category_id', 'price', 'status', 'slug')
            ->where('status', '=', 'pending')
            ->orWhere('status', '=', 'ditolak')
            ->with('category:id,name', 'mentor:id,name')
            ->get();

        $data =
            [
                'title' => 'Pendaftaran Kelas | Admin UMKM Plus',
                'active' => 'course',
                'courses' => $courses
            ];

        return view('admin.courses.application', $data);
    }

    public function applicationDetail(Course $course)
    {
        $course->load('modules.mediaModules', 'mentor', 'category');
        $data =
            [
                'title' => 'Detail Pendaftaran Kelas | Admin UMKM Plus',
                'active' => 'course',
                'course' => $course
            ];

        return view('admin.courses.applicationDetail', $data);
    }

    public function editApprovalApplication(Request $request, Course $course)
    {
        $data = [
            'title' => 'Edit Pendaftaran Kelas | Admin UMKM Plus',
            'active' => 'course',
            'course' => $course,
        ];

        return view('admin.courses.editApprovalApplication', $data);
    }

    public function updateApprovalApplication(Request $request, Course $course)
    {
        $update = $course->update([
            'status' => 'aktif'
        ]);

        if ($update) {
            return $request->ajax() ? ResponseFormatter::success(
                [
                    'message' => 'Kelas berhasil diaktifkan',
                    'redirect' => redirect()->route('admin.course.application')->getTargetUrl()
                ],
                'success'
            ) : redirect()->route('admin.course')->with('success', 'Kelas berhasil diaktifkan');
        }
        return  $request->ajax() ? ResponseFormatter::error(
            [
                'message' => 'Kelas gagal diaktifkan',
            ],
            'error',
        ) : redirect()->route('admin.course.application')->with('error', 'Kelas gagal diaktifkan');
    }

    public function rejectApplication(Course $course)
    {
        $update = $course->update([
            'status' => 'ditolak'
        ]);

        if ($update) {
            return ResponseFormatter::success(
                [
                    'message' => 'Kelas berhasil ditolak',
                    'redirect' => redirect()->route('admin.course.application')->getTargetUrl()
                ],
                'success'
            );
        }
        return ResponseFormatter::error(
            [
                'message' => 'Kelas gagal ditolak',
            ],
            'error',
        );
    }

    public function adminShow(Course $course)
    {
        $course->load('mentor', 'category')->loadCount('modules', 'courseEnrolls');
        $data = [
            'title' => $course->title . ' | UMKM Plus',
            'active' => 'course',
            'course' => $course
        ];

        return view('admin.courses.show', $data);
    }

    public function mentorCourse()
    {
        $courses = Course::with('category')->withCount('courseEnrolls')->whereMentorId(Auth::user()->customer->id)->get();
        $data = [
            'title' => 'Courses | Mentor UMKMPlus',
            'active' => 'course',
            'courses' => $courses
        ];

        return view('mentor.courses.index', $data);
    }

    public function mentorCourseCreate()
    {
        $data = [
            'title' => 'Create Course | Mentor UMKMPlus',
            'active' => 'course',
        ];

        return view('mentor.courses.create', $data);
    }

    public function mentorCourseShow(Course $course)
    {
        $course->load('courseEnrolls.student', 'modules.mediaModules', 'mentor', 'category');
        $data = [
            'title' => 'Detail ' . $course->title . ' | Mentor UMKMPlus',
            'active' => 'course',
            'course' => $course
        ];
        return view('mentor.courses.detail', $data);
    }
}
