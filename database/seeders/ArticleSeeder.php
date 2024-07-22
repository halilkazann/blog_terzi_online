<?php

namespace Database\Seeders;

use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        for($i = 0 ; $i < 50 ; $i ++){
            DB::table('articles')->insert([
               'category_id'=>rand(1,7),
                'title'=>fake()->paragraph(1),
                'slug'=>Str::slug(fake()->paragraph(1)),
                'image'=>fake()->imageUrl(),
                'content'=>fake()->paragraph(5),
                'created_at'=>now()

            ]);
        }
    }
}
