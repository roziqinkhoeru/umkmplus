<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Course;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function courseMentor()
    {
        $userID = Auth::user()->id;
        $courses = Course::with('category')->where('mentor_id', $userID)->get();

        $data =
            [
                'title' => 'Kelas Saya | UMKM Plus',
                'courses' => $courses,
            ];

        return view('courses.mentor', $data);
    }

    public function getCourseCategory(Request $request)
    {
        $courses = Course::dataMentorCategory()
            ->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            })
            ->limit(4)
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => $courses
        ]);
    }


    public function getCourseMentorCategory(Customer $customer)
    {
        $courses = Course::dataMentorCategory()
            ->whereMentorId($customer->id)
            ->limit(4)
            ->get();

        return ResponseFormatter::success(
            $courses,
            'Data list kelas berhasil diambil'
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data =
            [
                'title' => 'Tambah Kelas | UMKM Plus',
            ];

        return view('courses.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        Course::destroy($course->id);

        return redirect()->route('courses.index')->with('success', 'Kelas berhasil dihapus');
    }
}
