<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Module;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\RoleUser;
use App\Models\MediaModule;
use App\Models\CourseEnroll;
use App\Models\CustomerSpecialist;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Customer factory
        $customerRecord = [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'dob' => $this->faker->dateTimeBetween('-45 years', '-18 years')
        ];
        $customer = Customer::create($customerRecord);
        print($customer->id . "\n");

        // User factory
        $userRecord = [
            'customer_id' => $customer->id,
            'username' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('=Secret1234'), // password
            'remember_token' => Str::random(10),
        ];
        $user = User::create($userRecord);

        // RoleUser factory
        $roleUserRecord = [
            'role_id' => $this->faker->numberBetween(2, 3),
            'user_id' => $user->id,
        ];
        $roleUser = RoleUser::create($roleUserRecord);

        // CustomerSpecialist factory
        if ($roleUserRecord['role_id'] == 2) {
            $customerSpecialistRecord = [
                'customer_id' => $customer->id,
                'specialist_id' => $this->faker->randomElement([1, 2]),
            ];
        } else if ($roleUserRecord['role_id'] == 3) {
            $customerSpecialistRecord = [
                'customer_id' => $customer->id,
                'specialist_id' => $this->faker->randomElement([3, 4, 5]),
            ];
        };
        $customerSpecialist = CustomerSpecialist::create($customerSpecialistRecord);

        // Mentor
        if ($roleUserRecord['role_id'] == 2) {
            // Discount factory
            $discountRecord = [
                'mentor_id' => $customer->id,
                'code' => $this->faker->unique()->regexify('[A-Za-z0-9]{10}'),
                'discount' => $this->faker->numberBetween(1, 100),
                'status' => $this->faker->randomElement([0, 1]),
            ];
            $discount = Discount::create($discountRecord);

            // course factory
            for ($i = 0; $i < 4; $i++) {
                # code...
                $courseRecord = [
                    'mentor_id' => $customer->id,
                    'category_id' => $this->faker->numberBetween(1, 3),
                    'title' => $this->faker->sentence(3),
                    'description' => $this->faker->paragraph(3),
                    'thumbnail' => $this->faker->imageUrl(),
                    'price' => $this->faker->numberBetween(50000, 1000000),
                ];
                $course = Course::create($courseRecord);

                // module factory
                $moduleRecord = [
                    'course_id' => $course->id,
                    'title' => $this->faker->title(),
                    'file' => $this->faker->url(),
                    'no_module' => 1
                ];
                $module = Module::create($moduleRecord);

                // media module factory
                $mediaModuleRecord = [
                    'module_id' => $module->id,
                    'title' => $this->faker->title(),
                    'video_url' => "https://www.youtube.com/embed/PjB7cAF0jSc?list=RDBb69TOfPXn8",
                    'no_media' => 1,
                ];
                $mediaModule = MediaModule::create($mediaModuleRecord);
            }
        }

        // Student
        if ($roleUserRecord['role_id'] == 3) {
            // Course enroll factory
            for ($i = 0; $i < 3; $i++) {
                # code...
                $courses = Course::pluck('id')->toArray();
                $courseEnrollRecord = [
                    'student_id' => $customer->id,
                    'course_id' => $this->faker->randomElement($courses),
                    'status' => $this->faker->randomElement(['menunggu pembayaran', 'proses', 'aktif', 'selesai']),
                    'payment_proof' => $this->faker->imageUrl(),
                    'upto_no_module' => 1,
                    'upto_no_media' => 1,
                    'started_at' => $this->faker->dateTimeBetween('-1 years', '-4 months'),
                    'finished_at' => $this->faker->dateTimeBetween('-4 months', 'now'),
                ];
                $courseEnroll = CourseEnroll::create($courseEnrollRecord);
            }
        };

        return [
            'mentor_id' => 2,
            'code' => $this->faker->unique()->regexify('[A-Za-z0-9]{10}'),
            'discount' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
