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
                'description' => 'Kita akan membahas tentang pengembangan identitas merek yang kuat dan membedakan bisnis UMKM dari pesaing. Ini meliputi desain logo, penentuan pesan merek, pemilihan warna dan tipografi yang tepat, serta strategi branding yang efektif untuk membangun kesan yang konsisten pada pelanggan.',
            ],
            [
                'name' => 'Desain',
                'slug' => 'desain',
                'description' => 'Kita akan membahas mengenai penggunaan prinsip-prinsip desain untuk menciptakan produk dan tampilan visual yang menarik. Ini meliputi desain produk yang ergonomis dan fungsional, desain kemasan yang menarik, penggunaan desain grafis untuk materi pemasaran, serta pengembangan tampilan antarmuka yang intuitif dan menarik untuk pengguna.',
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'description' => 'Kita akan membahas mengenai strategi pemasaran untuk mengenalkan, mempromosikan, dan menjual produk atau layanan UMKM. Ini mencakup pemasaran digital seperti media sosial, SEO, dan iklan online, serta pengembangan kampanye pemasaran yang efektif untuk menjangkau target pasar dengan cara yang relevan dan menarik.',
            ],
            [
                'name' => 'Finance',
                'slug' => 'finance',
                'description' => 'Kita akan membahas mengenai pengelolaan keuangan dalam bisnis UMKM. Ini meliputi perencanaan keuangan, manajemen kas, analisis keuangan, pengelolaan hutang dan piutang, serta pemahaman tentang perpajakan dan aspek hukum keuangan yang relevan bagi UMKM.',
            ],
            [
                'name' => 'Technology & E-Commerce',
                'slug' => 'tech-and-ecommerce',
                'description' => 'Kita akan membahas mengenai penggunaan teknologi dan pemanfaatan e-commerce dalam bisnis UMKM. Ini meliputi pembuatan dan pengelolaan situs web, penggunaan platform e-commerce untuk menjual produk secara online, perlindungan keamanan data dan privasi, serta pemanfaatan alat digital dan analitik bisnis untuk meningkatkan efisiensi dan keputusan bisnis.',
            ],
            [
                'name' => 'SDM',
                'slug' => 'sdm',
                'description' => 'Kita akan membahas mengenai penggunaan teknologi dan pemanfaatan e-commerce dalam bisnis UMKM. Ini meliputi pembuatan dan pengelolaan situs web, penggunaan platform e-commerce untuk menjual produk secara online, perlindungan keamanan data dan privasi, serta pemanfaatan alat digital dan analitik bisnis untuk meningkatkan efisiensi dan keputusan bisnis.',
            ],

        ];

        foreach ($records as $record) {
            Category::firstOrCreate($record);
        }
    }
}
