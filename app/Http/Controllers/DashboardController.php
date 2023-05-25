<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $coursePopular = Course::with('mentor')
            ->withCount('courseEnrolls')
            // ->groupBy('mentor_id')
            ->orderBy('course_enrolls_count', 'desc')
            // ->select('mentor_id', DB::raw('MAX(courses.id) as id'))
            ->limit(5)
            ->get();
        // $mentor = Customer::select('customers.id', 'customers.name')
        //     ->count('course_enroll.id')
        //     ->mentor()
        //     ->join('courses', 'courses.mentor_id', '=', 'customers.id')
        //     ->join('course_enroll', 'course_enroll.course_id', '=', 'courses.id')
        //     ->groupBy('customers.id', 'customers.name')
        //     ->limit(5)
        //     ->get();
        dd($coursePopular);
        $data =
            [
                'title' => 'Dashboard | UMKM Plus',
                'categories' => $categories,
            ];

        return view('dashboard', $data);
    }

    public function getCourseCategory()
    {
    }
}
