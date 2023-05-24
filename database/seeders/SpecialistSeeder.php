<?php

namespace Database\Seeders;

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
            [
                'name' => "Branding",
                'description' => "Branding"
            ],
            [
                'name' => "Desain",
                'description' => "Desain"
            ],
            [
                'name' => "Marketing",
                'description' => "Marketing"
            ],
        ];

        foreach ($records as $record) {
            Specialist::firstOrCreate($record);
        }
    }
}
