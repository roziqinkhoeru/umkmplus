<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Course;
use App\Models\Module;
use App\Models\Category;
use App\Models\Customer;
use App\Models\MediaModule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
                'title' => 'Kelas Saya | UMKMPlus',
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
                'title' => 'Kelas | Admin UMKMPlus',
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
                'title' => 'Pendaftaran Kelas | Admin UMKMPlus',
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
                'title' => 'Detail Pendaftaran Kelas | Admin UMKMPlus',
                'active' => 'course',
                'course' => $course
            ];

        return view('admin.courses.applicationDetail', $data);
    }

    public function editApprovalApplication(Request $request, Course $course)
    {
        $data = [
            'title' => 'Edit Pendaftaran Kelas | Admin UMKMPlus',
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
            'title' => 'Kelas | Mentor UMKMPlus',
            'active' => 'course',
            'courses' => $courses
        ];

        return view('mentor.courses.index', $data);
    }

    public function mentorCourseShow(Course $course)
    {
        $course->load('courseEnrolls.student', 'modules', 'mentor', 'category');
        $data = [
            'title' => 'Detail ' . $course->title . ' | Mentor UMKMPlus',
            'active' => 'course',
            'course' => $course
        ];
        return view('mentor.courses.detail', $data);
    }
    public function mentorCourseCreate()
    {
        $categories = Category::all();
        $data = [
            'title' => 'Buat Kelas | Mentor UMKMPlus',
            'active' => 'course',
            'categories' => $categories
        ];

        return view('mentor.courses.create', $data);
    }

    public function mentorCourseStore(Request $request)
    {
        $rules =
            [
                'title' => 'required|max:100',
                'description' => 'required',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|integer|min:0',
                'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'file_info' => 'required|mimes:pdf|max:5120',
                'discount' => 'required|integer|min:0|max:100',
                'google_form' => 'required|url',
            ];
        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'message' => 'Gagal membuat kelas',
                    'error' => $validator->errors()->first()
                ],
                'Gagal membuat kelas',
                422
            );
        }

        $thumbnail = request()->file('thumbnail')->store('courses/thumbnail', 'public');
        $fileInfo = request()->file('file_info')->store('courses/info', 'public');

        $course = Course::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'thumbnail' => $thumbnail,
            'file_info' => $fileInfo,
            'google_form' => $request->google_form,
            'mentor_id' => Auth::user()->customer->id,
            'status' => 'pending'
        ]);

        if ($course) {
            return ResponseFormatter::success(
                [
                    'message' => 'Kelas berhasil dibuat',
                    'redirect' => route('mentor.module.create', $course->slug)
                ],
                'success'
            );
        }

        return ResponseFormatter::error(
            [
                'message' => 'Kelas gagal dibuat',
            ],
            'error',
        );
    }


    public function mentorCourseEdit(Course $course)
    {
        $categories = Category::all();
        $data = [
            'title' => 'Edit Kelas | Mentor UMKMPlus',
            'active' => 'course',
            'categories' => $categories,
            'course' => $course
        ];

        return view('mentor.courses.edit', $data);
    }

    public function mentorCourseUpdate(Request $request, Course $course)
    {
        $rules =
            [
                'title' => 'required|max:100',
                'description' => 'required',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|integer|min:0',
                'thumbnail' => 'image|mimes:jpg,jpeg,png|max:2048',
                'file_info' => 'mimes:pdf|max:5120',
                'discount' => 'required|integer|min:0|max:100',
                'google_form' => 'required|url',
            ];
        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'message' => 'Gagal membuat kelas',
                    'error' => $validator->errors()->first()
                ],
                'Gagal membuat kelas',
                422
            );
        }

        $thumbnail = $course->thumbnail;
        $fileInfo = $course->file_info;

        if (request()->file('thumbnail')) {
            // delete file old thumbnail
            if ($course->thumbnail != 'storage/courses/thumbnail/thumbnail-course.png') {
                # code...
                $exists = Storage::disk('public')->exists($course->thumbnail);
                if ($exists) {
                    Storage::disk('public')->delete($course->thumbnail);
                }
            }
            $thumbnail = request()->file('thumbnail')->store('courses/thumbnail', 'public');
        }

        if (request()->file('file_info')) {
            // delete file old file_info
            $exists = Storage::disk('public')->exists($course->file_info);
            if ($exists) {
                Storage::disk('public')->delete($course->file_info);
            }
            $fileInfo = request()->file('file_info')->store('courses/info', 'public');
        }

        $updateCourse = $course->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'thumbnail' => $thumbnail,
            'file_info' => $fileInfo,
            'google_form' => $request->google_form,
            'mentor_id' => Auth::user()->customer->id,
            // 'status' => 'pending'
        ]);

        dd($updateCourse);

        if ($updateCourse) {
            return ResponseFormatter::success(
                [
                    'message' => 'Kelas berhasil diupdate',
                    'redirect' => route('mentor.course')
                ],
                'Kelas berhasil diupdate'
            );
        }

        return ResponseFormatter::error(
            [
                'message' => 'Kelas gagal diupdate',
            ],
            'error',
        );
    }

    // delete course
    public function mentorCourseDestroy(Course $course)
    {
        // delete file old thumbnail
        if ($course->thumbnail != 'storage/courses/thumbnail/thumbnail-course.png') {
            # code...
            $exists = Storage::disk('public')->exists($course->thumbnail);
            if ($exists) {
                Storage::disk('public')->delete($course->thumbnail);
            }
        }

        // delete file old file_info
        $exists = Storage::disk('public')->exists($course->file_info);
        if ($exists) {
            Storage::disk('public')->delete($course->file_info);
        }

        $course->delete();

        if ($course) {
            return ResponseFormatter::success(
                [
                    'message' => 'Kelas berhasil dihapus',
                    'redirect' => route('mentor.course')
                ],
                'Kelas berhasil dihapus'
            );
        }

        return ResponseFormatter::error(
            [
                'message' => 'Kelas gagal dihapus',
            ],
            'error',
        );
    }
}
