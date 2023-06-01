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

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $courses = Course::where('title', 'LIKE', '%' . $request->searchNavbar . '%')->get();
        $data = [
            'title' => 'Kelas | UMKMPlus',
            'courses' => $courses
        ];

        return view('user.courses.index', $data);
    }

    public function getCourse(Request $request)
    {
        $courses = Course::query();
        $courses->with('mentor', 'category')
            ->withCount("modules", "courseEnrolls");
        if ($request->searchNavbar) {
            $courses->where('title', 'LIKE', '%' . $request->searchNavbar . '%');
        }
        if ($request->newRelease == "true") {
            $courses->orderBy('created_at', 'desc');
        } else if ($request->promotion == "true") {
            $courses->where('discount', '!=', 0)->orderBy('discount', 'desc');
        } else if ($request->popular == "true") {
            $courses->orderBy('course_enrolls_count', 'desc');
        } else if ($request->cheapestCourse == "true") {
            $courses->orderBy('price', 'asc');
        } else if ($request->expensiveCourse == "true") {
            $courses->orderBy('price', 'desc');
        } else if ($request->freeCourse == "true") {
            $courses->where('price', 0);
        }
        $courses = $courses->get();

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
        if ($categories->isEmpty()) {
            $data = [
                'title' => 'Kategori Kelas | UMKMPlus',
                'categories' => null
            ];
        } else {
            $data = [
                'title' => 'Kategori Kelas | UMKMPlus',
                'categories' => $categories
            ];
        }

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
        $courses = Course::query();
        $courses->with('mentor', 'category')
            ->withCount("modules", "courseEnrolls")
            ->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category->slug);
            });
        if ($request->searchCourse) {
            $courses->where('title', 'LIKE', '%' . $request->searchCourse . '%');
        }
        if ($request->newRelease == "true") {
            $courses->orderBy('created_at', 'desc');
        } else if ($request->promotion == "true") {
            $courses->where('discount', '!=', 0)->orderBy('discount', 'desc');
        } else if ($request->popular == "true") {
            $courses->orderBy('course_enrolls_count', 'desc');
        } else if ($request->cheapestCourse == "true") {
            $courses->orderBy('price', 'asc');
        } else if ($request->expensiveCourse == "true") {
            $courses->orderBy('price', 'desc');
        } else if ($request->freeCourse == "true") {
            $courses->where('price', 0);
        }
        $courses = $courses->get();

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
