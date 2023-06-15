<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\Customer;
use App\Models\MediaModule;
use App\Models\Mentor;
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
                    'profile_picture' => 'profile/mentor-1.jpg',
                    'phone' => "0123456789",
                    'dob' => "2000-01-01",
                    'gender' => "laki-laki",
                ],
                [
                    'name' => "Mentor",
                    'slug' => "mentor",
                    'job' => "Mentor",
                    'profile_picture' => 'profile/mentor-1.jpg',
                    'address' => "Mentor Address",
                    'phone' => "0123456789",
                    'dob' => "2000-01-01",
                    'gender' => "laki-laki",
                ],
                [
                    'name' => "Student",
                    'profile_picture' => 'profile/mentor-1.jpg',
                    'job' => "Student",
                    'address' => "Student Address",
                    'phone' => "0123456789",
                    'dob' => "2000-01-01",
                    'gender' => "laki-laki",
                ],
            ];

        foreach ($customerRecords as $customerRecord) {
            Customer::firstOrCreate($customerRecord);
        }

        $mentorRecord = [
            'customer_id' => 2,
            'about' => "Inventore reprehenderit aut doloremque voluptatem. Rem nihil voluptatem voluptatem sunt voluptas. Eos debitis et amet ut. Impedit aperiam ducimus et totam qui deleniti.",
            'status' => 1,
        ];

        $mentor = Mentor::firstOrCreate($mentorRecord);

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
        for ($i = 0; $i < 2; $i++) {
            # code...
            $courseRecord = [
                'mentor_id' => 2,
                'category_id' => $faker->numberBetween(1, 5),
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph(3),
                'thumbnail' => "courses/thumbnail/thumbnail-course.png",
                'price' => $faker->numberBetween(50000, 1000000),
                'discount' => 5,
                'file_info' => "courses/info/dummy-course.pdf",
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
                    'file' => "courses/modules/dummy-module.pdf",
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
                'status' => $faker->randomElement(['menunggu pembayaran', 'aktif', 'selesai']),
                'upto_no_module' => 1,
                'upto_no_media' => 1,
                'started_at' => $faker->dateTimeBetween('-5 months', '-1 months'),
                'finished_at' => $faker->dateTimeBetween('-1 months', 'now'),
                'total_price' => $course->price,
            ];
            $courseEnroll = CourseEnroll::create($courseEnrollRecord);

            if ($courseEnroll->status == 'aktif' || $courseEnroll->status == 'selesai') {
                $mentor->balance += ($courseEnroll->total_price * 0.8);
                $mentor->save();
            }

            $blogRecord = [
                'user_id' => 2,
                'title' => $faker->sentence(3),
                'content' => '<p class="text-lg mb-15">' . implode('</p><p class="text-lg mb-15">', $faker->paragraphs(6)) . '</p>',
                'headline' => $faker->paragraph(),
                'thumbnail' => "blogs/blog1.png",
                'status' => $faker->randomElement(['tampilkan', 'sembunyikan']),
            ];
            $blog = Blog::create($blogRecord);
            $blog->update([
                'slug' =>  Str::slug($blog->title, '-'),
            ]);
        }
    }
}
