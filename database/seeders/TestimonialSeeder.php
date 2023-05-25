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
        foreach ($courseEnrolls as $courseEnroll) {
            # code...
            if ($courseEnroll->status == "selesai") {
                Testimonial::firstOrCreate([
                    'student_id' => $courseEnroll->student_id,
                    'course_id' => $courseEnroll->course_id,
                    'testimonial' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum. Quisquam, voluptatum. Quisquam, voluptatum.',
                    'rating' => 5,
                    'status' => 'sembunyikan',
                ]);
            }
        }
    }
}
