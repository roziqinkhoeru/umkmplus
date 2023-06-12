<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\Customer;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function adminStudent()
    {
        $students = Customer::select('customers.id', 'customers.name', 'customers.phone', 'customers.address', 'users.email')
            ->withCount('studentCourseEnrolls')
            ->student()
            ->get();
        $data = [
            'title' => 'Data Siswa | Admin UMKMPlus',
            'active' => 'student',
            'students' => $students,
        ];

        return view('admin.students.index', $data);
    }

    public function adminStudentShow(Customer $customer)
    {
        $customer->load(['studentCourseEnrolls.course.category', 'studentCourseEnrolls.course.mentor']);
        $data = [
            'title' => 'Detail Siswa | Admin UMKMPlus',
            'active' => 'student',
            'student' => $customer,
        ];

        return view('admin.students.detail', $data);
    }

    public function mentorStudent()
    {
        $enrolls = CourseEnroll::with('course','student.user')
            ->with(['course' => function ($query) {
                $query->withTrashed();
            }])
            ->whereHas('course', function ($query) {
                $query->where('mentor_id', auth()->user()->customer->id);
            })
            ->get();
        $data = [
            'title' => 'Data Siswa | Mentor UMKMPlus',
            'active' => 'student',
            'enrolls' => $enrolls,
        ];

        return view('mentor.students.index', $data);
    }

    public function mentorUncompletedStudent()
    {
        $enrolls = CourseEnroll::where('status', 'selesai')
            ->where('score', null)
            ->whereHas('course', function ($query) {
                $query->where('mentor_id', auth()->user()->customer->id);
            })
            ->with(['course.category', 'student.user'])
            ->orderBy('finished_at', 'asc')
            ->get();
        $data = [
            'title' => 'Data Siswa | Mentor UMKMPlus',
            'active' => 'student',
            'enrolls' => $enrolls,
        ];

        return view('mentor.students.uncompleted', $data);
    }

    public function mentorUncompletedStudentEdit(CourseEnroll $courseEnroll)
    {
        $courseEnroll->load(['course.category', 'student.user']);
        $data = [
            'title' => 'Edit Siswa | Mentor UMKMPlus',
            'active' => 'student',
            'courseEnroll' => $courseEnroll,
        ];

        return view('mentor.students.edit', $data);
    }

    public function mentorUncompletedStudentUpdate(CourseEnroll $courseEnroll)
    {
        $courseEnroll->update([
            'score' => request('score'),
        ]);

        return ResponseFormatter::success(
            [
                'redirect' => redirect('/mentor/student')->getTargetUrl(),
            ],
            'Skor berhasil diperbarui'
        );
    }
}
