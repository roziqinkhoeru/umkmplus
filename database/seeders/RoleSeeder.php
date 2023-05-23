<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            [
                'name' => "admin",
                'description' => "admin"
            ],
            [
                'name' => "mentor",
                'description' => "mentor"
            ],
            [
                'name' => "student",
                'description' => "student"
            ],
        ];

        foreach ($records as $record) {
            Role::firstOrCreate($record);
        }
    }
}
