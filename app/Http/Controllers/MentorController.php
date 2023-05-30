<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'data' => $mentors
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

}
