<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            DB::table('admins')->insert([
                'name'=> "HalilKazan",
                'email'=> "halil@kazan.com",
                'password'=> bcrypt(102030),
                'created_at'=>now(),
                'updated_at'=>now()
            ]);

    }
}
