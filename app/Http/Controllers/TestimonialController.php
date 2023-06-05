<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
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
                'title' => 'Testimonial | UMKM Plus',
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
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        $data =
        [
            'title' => 'Edit Testimonial | UMKM Plus',
            'testimonial' => $testimonial
        ];

        return view('testimonials.edit', $data);
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

}
