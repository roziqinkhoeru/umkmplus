<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 5; $i++) {
            # code...
            $blogRecord = [
                'user_id' => 1,
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
