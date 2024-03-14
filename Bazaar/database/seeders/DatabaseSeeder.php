<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                'name' => 'Sander Smits',
                'email' => 'sandersmits1234@gmail.com',
                'password' => bcrypt('bazaar'),
            ],
            [

                'id' => 2,
                'name' => 'Sander Smitty',
                'email' => 'sandersmits0404@gmail.com',
                'password' => bcrypt('bazaar'),
            ],
            [
                'id'=> 3,
                'name'=> 'root',
                'email'=> 'root@root.nl',
                'password'=> bcrypt('root'),
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
        DB::table('companies')->insert([
            [
                'id' => 1,
                'owner_id' => 1,
                'custom_url' => 'jumbo',               
            ]
        ]);
    }

}
