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
        $testimonials = Testimonial::with('student')->where('status', 'tampilkan')->limit(3)->get();
        if (Auth::check()) {
            $countCart = Customer::countCart();
            $data =
                [
                    'title' => 'Dashboard | UMKM Plus',
                    'categories' => $categories,
                    'testimonials' => $testimonials,
                    'countCart' => $countCart,
                ];
        } else {

            $data =
                [
                    'title' => 'Dashboard | UMKM Plus',
                    'categories' => $categories,
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
}
