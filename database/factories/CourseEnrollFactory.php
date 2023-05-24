<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseEnroll>
 */
class CourseEnrollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $students = Customer::whereHas('user', function ($query) {
            $query->whereHas('roleUser', function ($query) {
                $query->whereHas('role', function ($query) {
                    $query->where('name', 'student');
                });
            });
        })->pluck('id')->toArray();
        $courses = Course::pluck('id')->toArray();
        return [
            'student_id' => $this->faker->randomElement($students),
            'course_id' => $this->faker->randomElement($courses),
            'status' => $this->faker->randomElement(['menunggu pembayaran', 'proses', 'aktif', 'selesai']),
            'payment_proof' => $this->faker->imageUrl(),
            'upto_no_module' => $this->faker->rand(1, 10),
            'upto_no_media' => $this->faker->rand(1, 10),
            'started_at' => $this->faker->dateTimeBetween('-1 years', '-4 months'),
            'finished_at' => $this->faker->dateTimeBetween('-4 months', 'now'),
        ];
    }
}
