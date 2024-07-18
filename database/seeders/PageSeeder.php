<?php

namespace Database\Seeders;

use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = ["Hakkımızda", "Kariyer", "Vizyonumuz", "Misyonumuz"];
        $count=0;
        foreach ($pages as $page) {

            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'slug' => Str::slug($page),
                'image' => 'https://imageio.forbes.com/specials-images/imageserve/633a774a842d06ecd68286ff/The-5-Biggest-Business-Trends-For-2023/960x0.jpg?format=jpg&width=1440',
                'content' => 'örnek açıklama',
                'order' => $count,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
