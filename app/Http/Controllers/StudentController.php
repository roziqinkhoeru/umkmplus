<?php

namespace App\Http\Controllers;

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
            'title' => 'Data Siswa | UMKM Plus',
            'active' => 'student',
            'students' => $students,
        ];

        return view('admin.students.index', $data);
    }

    public function adminStudentShow(Customer $customer)
    {
        $customer->load(['studentCourseEnrolls.course.category', 'studentCourseEnrolls.course.mentor']);
        $data = [
            'title' => 'Detail Siswa | UMKM Plus',
            'active' => 'student',
            'student' => $customer,
        ];

        return view('admin.students.detail', $data);
    }
}
