<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
}
