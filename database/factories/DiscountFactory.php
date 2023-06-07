<?php

namespace Database\Factories;

use App\Models\Blog;
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
            'profile_picture' => 'assets/img/dummy/mentor-1.jpg',
            'job' => $this->faker->jobTitle(),
            'phone' => $this->faker->phoneNumber(),
            'dob' => $this->faker->dateTimeBetween('-45 years', '-18 years'),
            'gender' => $this->faker->randomElement(['laki-laki', 'perempuan']),
        ];
        $customer = Customer::create($customerRecord);

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
        if ($roleUserRecord['role_id'] == 3) {

            $customerSpecialistRecord = [
                'customer_id' => $customer->id,
                'specialist_id' => $this->faker->randomElement([1, 2]),
            ];
        } else if ($roleUserRecord['role_id'] == 2) {
            $customer->update([
                'status' => 1,
                'about' => $this->faker->paragraph(3),
                'slug' =>  Str::lower(Str::slug($customer->name, '-')),
            ]);
            $customerSpecialistRecord = [
                'customer_id' => $customer->id,
                'specialist_id' => $this->faker->randomElement([3, 4, 5]),
            ];
        };
        $customerSpecialist = CustomerSpecialist::create($customerSpecialistRecord);

        // Mentor
        if ($roleUserRecord['role_id'] == 2) {
            for ($i = 0; $i < 4; $i++) {
                // Discount factory
                $discountRecord = [
                    'mentor_id' => $customer->id,
                    'code' => $this->faker->unique()->regexify('[A-Za-z0-9]{10}'),
                    'discount' => $this->faker->numberBetween(100000, 300000),
                    'status' => $this->faker->randomElement([0, 1]),
                ];
                $discount = Discount::create($discountRecord);

                // course factory
                $courseRecord = [
                    'mentor_id' => $customer->id,
                    'category_id' => $this->faker->numberBetween(1, 3),
                    'title' => $this->faker->sentence(3),
                    'description' => $this->faker->paragraph(3),
                    'thumbnail' => "assets/img/dummy/thumbnail-course.png",
                    'price' => $this->faker->numberBetween(50000, 1000000),
                    'discount' => 5,
                    'file_info' => "courses/info/Print-Kartu-UTS.pdf",
                    'google_form' => "https://docs.google.com/forms/d/e/1FAIpQLScDv5I9giiJaDkk1h6DYjdmSjf_-ZTRByTvy8LvRH_XHUDn9g/viewform"
                ];
                $course = Course::create($courseRecord);
                $course->update([
                    'slug' =>  Str::lower(Str::slug($course->title, '-')),
                ]);
                if ($i < 3) {
                    $course->update([
                        'status' =>  "aktif",
                    ]);
                }
                for ($j = 1; $j < 5; $j++) {

                    // module factory
                    $moduleRecord = [
                        'course_id' => $course->id,
                        'title' => $this->faker->words(3, true),
                        'file' => $this->faker->url(),
                        'no_module' => $j
                    ];
                    $module = Module::create($moduleRecord);
                    $module->update([
                        'slug' =>  Str::lower(Str::slug($module->title, '-')),
                    ]);
                    for ($k = 1; $k < 5; $k++) {

                        // media module factory
                        $mediaModuleRecord = [
                            'module_id' => $module->id,
                            'title' => $this->faker->words(3, true),
                            'video_url' => "PjB7cAF0jSc",
                            'duration' => $this->faker->numberBetween(1, 100),
                            'no_media' => $k,
                        ];
                        $mediaModule = MediaModule::create($mediaModuleRecord);
                    }
                }

                // blog factory

                $blogRecord = [
                    'user_id' => $user->id,
                    'title' => $this->faker->sentence(3),
                    'content' => '<p class="text-lg mb-15">' . implode('</p><p class="text-lg mb-15">', $this->faker->paragraphs(6)) . '</p>',
                    'headline' => $this->faker->paragraph(),
                    'thumbnail' => "blogs/blog1.png",
                    'status' => $this->faker->randomElement(['tampilkan', 'sembunyikan']),
                ];
                $blog = Blog::create($blogRecord);
                $blog->update([
                    'slug' =>  Str::slug($blog->title, '-'),
                ]);
            }
        }

        // Student
        if ($roleUserRecord['role_id'] == 3) {
            // Course enroll factory
            for ($i = 0; $i < 3; $i++) {
                $coursesID = Course::pluck('id')->toArray();
                $course = Course::find($this->faker->randomElement($coursesID));
                $courseEnrollRecord = [
                    'id' => $this->faker->unique()->uuid(),
                    'student_id' => $customer->id,
                    'course_id' => $course->id,
                    'status' => $this->faker->randomElement(['menunggu pembayaran', 'proses', 'aktif', 'selesai']),
                    'upto_no_module' => 1,
                    'upto_no_media' => 1,
                    'started_at' => $this->faker->dateTimeBetween('-1 years', '-4 months'),
                    'finished_at' => $this->faker->dateTimeBetween('-4 months', 'now'),
                    'total_price' => $course->price,
                ];
                $courseEnroll = CourseEnroll::create($courseEnrollRecord);
            }
        };

        return [
            'mentor_id' => 2,
            'code' => $this->faker->unique()->regexify('[A-Za-z0-9]{10}'),
            'discount' => $this->faker->numberBetween(100000, 300000),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
