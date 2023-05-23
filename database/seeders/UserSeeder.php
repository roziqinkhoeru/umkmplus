<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;


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
                'phone' => "0123456789",
                'dob' => "2000-01-01"
            ],
            [
                'name' => "Mentor",
                'address' => "Mentor Address",
                'phone' => "0123456789",
                'dob' => "2000-01-01"
            ],
            [
                'name' => "Student",
                'address' => "Student Address",
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
                'customer_id' => null,
                'username' => 1,
                'email' => "admin@gmail.com",
                'password' => bcrypt('=Secret1234'),
            ],
            [
                'customer_id' => 1,
                'username' => 2,
                'email' => "mentor@gmail.com",
                'password' => bcrypt('=Secret1234'),
            ],
            [
                'customer_id' => 2,
                'username' => 3,
                'email' => "student@gmail.com",
                'password' => bcrypt('=Secret1234'),
            ],
        ];

        foreach ($userRecords as $userRecord) {
            User::firstOrCreate($userRecord);
        }

        $faker = Factory::create();

        $recordCourses =
        [
            [
                'mentor_id' => 2,
                'category_id' => $faker->numberBetween(1, 3),
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph(3),
                'thumbnail' => $faker->imageUrl(),
                'price' => $faker->numberBetween(50000, 1000000),
            ],
            [
                'mentor_id' => 2,
                'category_id' => $faker->numberBetween(1, 3),
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph(3),
                'thumbnail' => $faker->imageUrl(),
                'price' => $faker->numberBetween(50000, 1000000),
            ],
            [
                'mentor_id' => 2,
                'category_id' => $faker->numberBetween(1, 3),
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph(3),
                'thumbnail' => $faker->imageUrl(),
                'price' => $faker->numberBetween(50000, 1000000),
            ],
            [
                'mentor_id' => 2,
                'category_id' => $faker->numberBetween(1, 3),
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph(3),
                'thumbnail' => $faker->imageUrl(),
                'price' => $faker->numberBetween(50000, 1000000),
            ],
            [
                'mentor_id' => 2,
                'category_id' => $faker->numberBetween(1, 3),
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph(3),
                'thumbnail' => $faker->imageUrl(),
                'price' => $faker->numberBetween(50000, 1000000),
            ],
        ];

        foreach ($recordCourses as $recordCourse) {
            Course::firstOrCreate($recordCourse);
        }

        // User::factory()->count(50)->create();
    }
}
