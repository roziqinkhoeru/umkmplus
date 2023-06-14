<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\CourseEnroll;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

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
        $enrolls = CourseEnroll::with('course', 'student.user')
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
        $rules = [
            'score' => 'required|numeric|min:0|max:100',
        ];
        $validator = validator(request()->all(), $rules);

        if ($validator->fails()) {
            return ResponseFormatter::error(
                [
                    'errors' => $validator->errors()->first(),
                ],
                'Gagal memperbarui skor',
                422
            );
        }

        $courseEnroll->update([
            'score' => request('score'),
        ]);

        $pdf = PDF::loadview('mentor.exports.certificate', compact('courseEnroll'));
        $pdf->setPaper('A4', 'landscape');

        // Set path penyimpanan file PDF di direktori storage
        $path = storage_path('app/public/certificates');

        // Pastikan direktori penyimpanan ada
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        // Set nama file PDF
        $fileName = 'UMKMPlus-' . $courseEnroll->course->title . '.pdf';

        // Simpan file PDF ke direktori storage
        $pdf->save($path . '/' . $fileName);
        // $filePath = $pdf->storeAs('certificates', $fileName, 'public'); // Menyimpan file di folder 'storage/app/public/cv'
        return ResponseFormatter::success(
            [
                'redirect' => redirect('/mentor/student')->getTargetUrl(),
            ],
            'Skor berhasil diperbarui dan Sertifikat berhasil dikirimkan',
        );
    }
}
