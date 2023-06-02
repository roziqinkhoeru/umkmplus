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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data =
            [
                'title' => 'Tambah Kelas | UMKM Plus',
            ];

        return view('courses.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
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
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
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
        $courses = Course::select('title', 'mentor_id', 'category_id', 'price', 'status')
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

    public function application()
    {
        $courses = Course::select('title', 'mentor_id', 'category_id', 'price', 'status', 'slug')
            ->where('status', '=', 'pending')
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
        $data =
            [
                'title' => 'Detail Pendaftaran Kelas | Admin UMKM Plus',
                'active' => 'course',
                'course' => $course
            ];
        dd($course);

        return view('admin.courses.applicationDetail', $data);
    }

    public function approvalApplication(Request $request, Course $course)
    {
        $rules = [
            'status' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'message' => 'Invalid input',
                    'error' => $validator->errors()->first()
                ],
                'Validation Error',
                422
            );
        }
        $update = $course->update([
            'status' => $request->status
        ]);

        if ($update) {
            return ResponseFormatter::success(
                [
                    'message' => 'Kelas berhasil diaktifkan',
                    'redirect' => redirect()->route('admin.courses.application')->getTargetUrl()
                ],
                'success'
            );
        }
        return ResponseFormatter::error(
            [
                'message' => 'Kelas gagal diaktifkan',
            ],
            'error',
        );
    }

    public function studentCourse(Course $course)
    {
        $course->load('courseEnrolls');
        dd($course->courseEnrolls);
        $data = [
            'title' => $course->title . ' | UMKM Plus',
            'course' => $course
        ];

        return view('admin.courses.student', $data);
    }
}
