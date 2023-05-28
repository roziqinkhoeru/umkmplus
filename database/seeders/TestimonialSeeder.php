<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseEnrolls = \App\Models\CourseEnroll::all();
        $i = 0;
        foreach ($courseEnrolls as $courseEnroll) {
            # code...
            if ($courseEnroll->status == "selesai") {
                if ($i % 5 == 0 && $i != 0) {
                    $status = 'tampilkan';
                } else {
                    $status = 'sembunyikan';
                }
                Testimonial::firstOrCreate([
                    'student_id' => $courseEnroll->student_id,
                    'course_id' => $courseEnroll->course_id,
                    'testimonial' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum. Quisquam, voluptatum. Quisquam, voluptatum.',
                    'rating' => 5,
                    'status' => $status,
                ]);
            }
        }
    }
}
