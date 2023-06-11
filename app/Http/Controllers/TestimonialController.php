<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =
            [
                'title' => 'Testimonial | UMKMPlus',
                'testimonials' => Testimonial::all()
            ];

        return view('testimonials.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CourseEnroll $courseEnroll)
    {
        $rules =
            [
                'testimonial' => 'required|min:3',
                'rating' => 'required|numeric|min:1|max:5',
            ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors()->first()
            ], 'Harap isi form dengan benar', 400);
        }

        $testimonial = Testimonial::create([
            'course_enroll_id' => $courseEnroll->id,
            'testimonial' => $request->testimonial,
            'rating' => $request->rating,
            'status' => 'sembunyikan',
        ]);

        if ($testimonial) {
            return ResponseFormatter::success([
                'redirect' => redirect()->route('course.certificate', $courseEnroll->id)->getTargetUrl()
            ], 'Testimonial berhasil ditambahkan');
        }

        return ResponseFormatter::error([
            'error' => 'Testimonial gagal ditambahkan'
        ], 'Testimonial gagal ditambahkan', 400);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {

        $rules =
            [
                'status' => 'required|in:sembunyikan,tampilkan',
            ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors()
            ], 'Harap isi form dengan benar', 400);
        }

        $testimonial->update([
            'status' => $request->status,
        ]);

        if ($testimonial) {
            return ResponseFormatter::success([
                'redirect' => redirect()->route('testimonial.index')->getTargetUrl()
            ], 'Testimonial berhasil diubah');
        }

        return ResponseFormatter::error([
            'error' => 'Testimonial gagal diubah'
        ], 'Testimonial gagal diubah', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        if ($testimonial) {
            return ResponseFormatter::success([
                'redirect' => redirect()->route('testimonial.index')->getTargetUrl()
            ], 'Testimonial berhasil dihapus');
        }

        return ResponseFormatter::error([
            'error' => 'Testimonial gagal dihapus'
        ], 'Testimonial gagal dihapus', 400);
    }

    public function adminTestimonial()
    {
        $testimonials = Testimonial::with([
            'courseEnroll.course' => function ($query) {
                $query->select('id', 'title');
            },
            'courseEnroll.student' => function ($query) {
                $query->select('id', 'name', 'job');
            }
        ])->get();
        $data =
            [
                'title' => 'Testimonial | Admin UMKMPlus',
                'active' => 'testimonial',
                'testimonials' => $testimonials
            ];

        return view('admin.testimonials.index', $data);
    }

    public function editStatusTestimonial(Request $request, Testimonial $testimonial)
    {
        $update = $testimonial->update([
            'status' => $request->status
        ]);

        if ($update) {
            return ResponseFormatter::success([
                'redirect' => redirect()->route('admin.testimonial')->getTargetUrl()
            ], 'Status Testimonial berhasil diubah');
        }

        return ResponseFormatter::error([
            'error' => 'Status Testimonial gagal diubah'
        ], 'Status Testimonial gagal diubah', 400);
    }

    public function mentorCourseTestimonial(Course $course)
    {
        $testimonials = Testimonial::with([
            'courseEnroll.student' => function ($query) {
                $query->select('id', 'name', 'job');
            }
        ])->whereHas('courseEnroll', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->get();

        if ($testimonials) {
            return ResponseFormatter::success([
                'testimonials' => $testimonials
            ], 'Data Testimonial berhasil diambil');
        }

        return ResponseFormatter::error([
            'error' => 'Data Testimonial gagal diambil'
        ], 'Data Testimonial gagal diambil', 400);
    }
}
