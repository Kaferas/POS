<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert(
            [
                'name' => "Kaferas",
                'is_admin' => 1,
                "email" => "Chrisirak95@gmail.com",
                "password" => Hash::make("K@feras12")
            ]
        );
    }
}
