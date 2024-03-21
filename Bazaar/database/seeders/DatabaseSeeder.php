<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function PHPSTORM_META\map;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Insert users first
        DB::table("users")->insert([
            [
                'id' => 1,
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => bcrypt('user'),
                'role' => 'user',

            ],
            [

                'id' => 2,
                'name' => 'advertiser',
                'email' => 'advertiser@advertiser.com',
                'password' => bcrypt('advertiser'),
                'role' => 'advertiser',
            ],
            [
                'id'=> 3,
                'name'=> 'root',
                'email'=> 'root@root.nl',
                'password'=> bcrypt('root'),
                'role'=> 'admin'
            ],
            [
                'id'=> 4,
                'name'=> 'admin',
                'email'=> 'admin@admin.com',
                'password'=> bcrypt('admin'),
                'role'=> 'admin'
            ],
            [
                'id'=> 5,
                'name'=> 'company',
                'email'=> 'company@company.com',
                'password'=> bcrypt('company'),
                'role'=> 'company'
            ]
        ]);

        // Then insert adverts
        DB::table('adverts')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'price' => 8.00,
                'title' => 'broodje',
                'advertisement_text' => 'dit broodje is lekker',
                'expires_at' => null
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'price' => 12.00,
                'title' => 'lekkerder broodje',
                'advertisement_text' => 'deze broodje grote lekker',
                'expires_at' => null
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'price' => 1.00,
                'title' => 'lekkerste broodje',
                'advertisement_text' => 'deze broodje grootste lekker',
                'expires_at' => '2024-03-02 00:00:00',

            ]
        ]);
    }

}
