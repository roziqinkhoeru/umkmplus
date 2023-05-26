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
                'slug' => 'branding',
                'description' => 'Kategori Branding',
            ],
            [
                'name' => 'Desain',
                'slug' => 'desain',
                'description' => 'Kategori Desain',
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'description' => 'Kategori Marketing',
            ],
        ];

        foreach ($records as $record) {
            Category::firstOrCreate($record);
        }
    }
}
