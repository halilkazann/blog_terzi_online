<?php

namespace Database\Seeders;

use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Truncate extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('articles')->truncate();
        DB::table('categories')->truncate();
        DB::table('pages')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
