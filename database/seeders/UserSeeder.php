<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\Customer;
use App\Models\MediaModule;
use App\Models\Module;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customerRecords =
            [
                [
                    'name' => "Admin",
                    'address' => "Admin Address",
                    'profile_picture' => 'assets/img/dummy/mentor-1.jpg',
                    'job' => "Admin",
                    'phone' => "0123456789",
                    'dob' => "2000-01-01",
                ],
                [
                    'name' => "Mentor",
                    'slug' => "mentor",
                    'address' => "Mentor Address",
                    'profile_picture' => 'assets/img/dummy/mentor-1.jpg',
                    'job' => "Mentor",
                    'phone' => "0123456789",
                    'dob' => "2000-01-01",
                    'about' => "Inventore reprehenderit aut doloremque voluptatem. Rem nihil voluptatem voluptatem sunt voluptas. Eos debitis et amet ut. Impedit aperiam ducimus et totam qui deleniti."
                ],
                [
                    'name' => "Student",
                    'address' => "Student Address",
                    'profile_picture' => 'assets/img/dummy/mentor-1.jpg',
                    'job' => "Student",
                    'phone' => "0123456789",
                    'dob' => "2000-01-01"
                ],
            ];

        foreach ($customerRecords as $customerRecord) {
            Customer::firstOrCreate($customerRecord);
        }

        $userRecords =
            [
                [
                    'customer_id' => 1,
                    'username' => "admin",
                    'email' => "admin@gmail.com",
                    'password' => bcrypt('=Secret1234'),
                ],
                [
                    'customer_id' => 2,
                    'username' => "mentor",
                    'email' => "mentor@gmail.com",
                    'password' => bcrypt('=Secret1234'),
                ],
                [
                    'customer_id' => 3,
                    'username' => "student",
                    'email' => "student@gmail.com",
                    'password' => bcrypt('=Secret1234'),
                ],
            ];

        foreach ($userRecords as $userRecord) {
            User::firstOrCreate($userRecord);
        }

        $roleUserRecords =
            [
                [
                    'user_id' => 1,
                    'role_id' => 1,
                ],
                [
                    'user_id' => 2,
                    'role_id' => 2,
                ],
                [
                    'user_id' => 3,
                    'role_id' => 3,
                ],
            ];

        foreach ($roleUserRecords as $roleUserRecord) {
            RoleUser::firstOrCreate($roleUserRecord);
        }

        $faker = Factory::create();

        // course factory
        for ($i = 0; $i < 4; $i++) {
            # code...
            $courseRecord = [
                'mentor_id' => 2,
                'category_id' => $faker->numberBetween(1, 3),
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph(3),
                'thumbnail' => "assets/img/dummy/thumbnail-course.png",
                'price' => $faker->numberBetween(50000, 1000000),
                'discount' => 5,
                'file_info' => "courses/info/Print-Kartu-UTS.pdf",
                'google_form' => "https://docs.google.com/forms/d/e/1FAIpQLScDv5I9giiJaDkk1h6DYjdmSjf_-ZTRByTvy8LvRH_XHUDn9g/viewform",
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
                    'title' => $faker->words(3, true),
                    'file' => $faker->url(),
                    'no_module' => $j,
                ];
                $module = Module::create($moduleRecord);
                $module->update([
                    'slug' =>  Str::lower(Str::slug($module->title, '-')),
                ]);
                for ($k = 1; $k < 4; $k++) {

                    // media module factory
                    $mediaModuleRecord = [
                        'module_id' => $module->id,
                        'title' => $faker->words(3, true),
                        'video_url' => "PjB7cAF0jSc",
                        'duration' => $faker->numberBetween(1, 100),
                        'no_media' => $k,
                    ];
                    $mediaModule = MediaModule::create($mediaModuleRecord);
                }
            }

            $courseEnrollRecord = [
                'id' => $faker->unique()->uuid(),
                'student_id' => 3,
                'course_id' => $course->id,
                'status' => $faker->randomElement(['menunggu pembayaran', 'proses', 'aktif', 'selesai']),
                'upto_no_module' => 1,
                'upto_no_media' => 1,
                'started_at' => $faker->dateTimeBetween('-1 years', '-4 months'),
                'finished_at' => $faker->dateTimeBetween('-4 months', 'now'),
                'total_price' => $course->price,
            ];
            $courseEnroll = CourseEnroll::create($courseEnrollRecord);

            $blogRecord = [
                'user_id' => 2,
                'title' => $faker->sentence(3),
                'content' => '<p class="text-lg mb-15">' . implode('</p><p class="text-lg mb-15">', $faker->paragraphs(6)) . '</p>',
                'headline' => $faker->paragraph(),
                'thumbnail' => "assets/img/dummy/blog1.png",
                'status' => $faker->randomElement(['tampilkan', 'sembunyikan']),
            ];
            $blog = Blog::create($blogRecord);
            $blog->update([
                'slug' =>  Str::slug($blog->title, '-'),
            ]);
        }
    }
}
