<?php

namespace Database\Seeders;

use App\Models\Course;
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
                'customer_id' =>2,
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

        // $recordCourses =
        // [
        //     [
        //         'mentor_id' => 2,
        //         'category_id' => $faker->numberBetween(1, 3),
        //         'title' => "course 1",
        //         'slug' => 'course-1',
        //         'description' => $faker->paragraph(3),
        //         'thumbnail' => "assets/img/dummy/thumbnail-course.png",
        //         'price' => $faker->numberBetween(50000, 1000000),
        //         'status' => 'nonaktif'
        //     ],
        //     [
        //         'mentor_id' => 2,
        //         'category_id' => $faker->numberBetween(1, 3),
        //         'title' => "course 2",
        //         'slug' => 'course-2',
        //         'description' => $faker->paragraph(3),
        //         'thumbnail' => "assets/img/dummy/thumbnail-course.png",
        //         'price' => $faker->numberBetween(50000, 1000000),
        //         'status' => 'nonaktif'
        //     ],
        //     [
        //         'mentor_id' => 2,
        //         'category_id' => $faker->numberBetween(1, 3),
        //         'title' => "course 3",
        //         'slug' => 'course-3',
        //         'description' => $faker->paragraph(3),
        //         'thumbnail' => "assets/img/dummy/thumbnail-course.png",
        //         'price' => $faker->numberBetween(50000, 1000000),
        //         'status' => 'aktif'
        //     ],
        //     [
        //         'mentor_id' => 2,
        //         'category_id' => $faker->numberBetween(1, 3),
        //         'title' => "course 4",
        //         'slug' => 'course-4',
        //         'description' => $faker->paragraph(3),
        //         'thumbnail' => "assets/img/dummy/thumbnail-course.png",
        //         'price' => $faker->numberBetween(50000, 1000000),
        //         'status' => 'nonaktif'
        //     ],
        //     [
        //         'mentor_id' => 2,
        //         'category_id' => $faker->numberBetween(1, 3),
        //         'title' => "course 5",
        //         'slug' => 'course-5',
        //         'description' => $faker->paragraph(3),
        //         'thumbnail' => "assets/img/dummy/thumbnail-course.png",
        //         'price' => $faker->numberBetween(50000, 1000000),
        //         'status' => 'aktif'
        //     ],
        // ];

        // foreach ($recordCourses as $recordCourse) {
        //     Course::firstOrCreate($recordCourse);
        // }

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
                'discount' => 5
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

            // module factory
            $moduleRecord = [
                'course_id' => $course->id,
                'title' => $faker->title(),
                'file' => $faker->url(),
                'no_module' => 1
            ];
            $module = Module::create($moduleRecord);
            $module->update([
                'slug' =>  Str::lower(Str::slug($module->title, '-')),
            ]);

            // media module factory
            $mediaModuleRecord = [
                'module_id' => $module->id,
                'title' => $faker->title(),
                'video_url' => "https://www.youtube.com/embed/PjB7cAF0jSc?list=RDBb69TOfPXn8",
                'no_media' => 1,
            ];
            $mediaModule = MediaModule::create($mediaModuleRecord);
        }
    }
}
