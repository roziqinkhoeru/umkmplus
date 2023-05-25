<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Customer;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $mentorPopulars = Customer::select('customers.id', 'customers.name', 'customers.job', DB::raw('count(course_enrolls.id) as total_student'))
            ->leftJoin('courses', 'courses.mentor_id', '=', 'customers.id')
            ->leftJoin('course_enrolls', 'course_enrolls.course_id', '=', 'courses.id')
            ->groupBy('customers.id')
            ->orderBy('total_student', 'desc')
            ->limit(4)
            ->get();
        foreach ($mentorPopulars as $mentorPopular) {
            $totalCourse = Customer::select('courses.id')->join('courses', 'courses.mentor_id', '=', 'customers.id')->where('customers.id', $mentorPopular->id)->count();
            $mentorPopular->total_course = $totalCourse;
        }
        $testimonials = Testimonial::with('student')->where('status', 'tampilkan')->limit(3)->get();
        if (Auth::check()) {
            $countCart = Customer::countCart();
            $data =
                [
                    'title' => 'Dashboard | UMKM Plus',
                    'categories' => $categories,
                    'mentorPopulars' => $mentorPopulars,
                    'testimonials' => $testimonials,
                    'countCart' => $countCart,
                ];
        } else {

            $data =
                [
                    'title' => 'Dashboard | UMKM Plus',
                    'categories' => $categories,
                    'mentorPopulars' => $mentorPopulars,
                    'testimonials' => $testimonials
                ];
        }

        return view('user.home', $data);
    }

    public function getCourseCategory(Request $request)
    {
        $courses = Course::with('mentor', 'category',)
            ->withCount("modules", "courseEnrolls")
            ->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            })->orderBy("course_enrolls_count", "desc")
            ->limit(4)
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => $courses
        ]);
    }
}
