<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function adminStudent()
    {
        $students = Customer::student()->get();
        dd($students);
        $data = [
            'title' => 'Data Siswa | UMKM Plus',
            'students' => $students,
        ];

        return view('admin.students.index', $data);
    }

    public function adminStudentShow(Customer $customer)
    {
        $data = [
            'title' => 'Detail Siswa | UMKM Plus',
            'student' => $customer,
        ];

        return view('admin.students.show', $data);
    }
}
