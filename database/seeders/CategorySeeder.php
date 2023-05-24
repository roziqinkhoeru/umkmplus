<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            [
                'name' => 'Branding',
                'description' => 'Kategori Branding',
            ],
            [
                'name' => 'Desain',
                'description' => 'Kategori Desain',
            ],
            [
                'name' => 'Marketing',
                'description' => 'Kategori Marketing',
            ],
        ];

        foreach ($records as $record) {
            Category::firstOrCreate($record);
        }
    }
}
