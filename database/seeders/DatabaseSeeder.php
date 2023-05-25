<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\CourseEnroll;
use App\Models\Customer;
use App\Models\CustomerSpecialist;
use App\Models\Discount;
use App\Models\MediaModule;
use App\Models\Module;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Customer::factory()->count(60)->create();
        // $this->call([
        //     CategorySeeder::class,
        //     RoleSeeder::class,
        //     SpecialistSeeder::class,
        //     UserSeeder::class,
        // ]);
        // Discount::factory()->count(100)->create();
        $this->call([
            TestimonialSeeder::class,
        ]);
    }
}
