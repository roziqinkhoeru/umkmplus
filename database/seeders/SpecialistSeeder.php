<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Specialist as Specialist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records =
            [
                [
                    'name' => "Pelaku Bisnis",
                    'description' => "Pelaku Bisnis"
                ],
                [
                    'name' => "Karyawan",
                    'description' => "Karyawan"
                ],
            ];

        foreach ($records as $record) {
            Specialist::firstOrCreate($record);
        }
        $categories = Category::all();

        foreach ($categories as $category) {
            Specialist::firstOrCreate([
                'name' => $category->name,
                'description' => $category->name
            ]);
        }
    }
}
