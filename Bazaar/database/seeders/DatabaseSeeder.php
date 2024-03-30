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
                'expires_at' => '2025-03-02 00:00:00',
                'advert_type' => 'sale'
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'price' => 12.00,
                'title' => 'lekkerder broodje',
                'advertisement_text' => 'deze broodje grote lekker',
                'expires_at' => '2025-03-02 00:00:00',
                'advert_type' => 'sale'
            ],
            ['id' => 3, 'user_id' => 1, 'price' => 14.00, 'title' => 'carpacio broodje','advertisement_text' => 'deze broodje grote lekker met vlees', 'expires_at' => '2025-03-02 00:00:00', 'advert_type' => 'sale'],
            ['id' => 4, 'user_id' => 3, 'price' => 10.00, 'title' => 'vegan broodje', 'advertisement_text' => '100% plantaardig broodje', 'expires_at' => '2025-04-01 00:00:00', 'advert_type' => 'sale'],
            ['id' => 5, 'user_id' => 1, 'price' => 9.50, 'title' => 'kaas broodje', 'advertisement_text' => 'broodje met oude kaas', 'expires_at' => '2025-05-05 00:00:00', 'advert_type' => 'sale'],
            ['id' => 6, 'user_id' => 2, 'price' => 15.00, 'title' => 'deluxe broodje', 'advertisement_text' => 'luxe broodje met exclusieve ingrediënten', 'expires_at' => '2025-06-10 00:00:00', 'advert_type' => 'sale'],
            ['id' => 7, 'user_id' => 3, 'price' => 11.00, 'title' => 'italiaans broodje', 'advertisement_text' => 'italiaanse kruiden en mozzarella', 'expires_at' => '2025-07-20 00:00:00', 'advert_type' => 'sale'],
            ['id' => 8, 'user_id' => 1, 'price' => 13.00, 'title' => 'kruidig broodje', 'advertisement_text' => 'met pikante kip en speciale saus', 'expires_at' => '2025-08-15 00:00:00', 'advert_type' => 'sale'],
            ['id' => 9, 'user_id' => 2, 'price' => 7.50, 'title' => 'eenvoudig broodje', 'advertisement_text' => 'simpel maar heerlijk broodje ham', 'expires_at' => '2025-09-05 00:00:00', 'advert_type' => 'sale'],
            ['id' => 10, 'user_id' => 3, 'price' => 16.50, 'title' => 'gourmet broodje', 'advertisement_text' => 'met premium rundvlees en truffelmayo', 'expires_at' => '2025-10-30 00:00:00', 'advert_type' => 'sale'],
            ['id' => 11, 'user_id' => 1, 'price' => 8.75, 'title' => 'ontbijt broodje', 'advertisement_text' => 'perfect start van je dag', 'expires_at' => '2025-11-25 00:00:00', 'advert_type' => 'sale'],
            ['id' => 12, 'user_id' => 3, 'price' => 12.00, 'title' => 'pittig broodje', 'advertisement_text' => 'met hete saus en jalapeños', 'expires_at' => '2025-12-15 00:00', 'advert_type' => 'sale'],
            ['id' => 13, 'user_id' => 2, 'price' => 14.00, 'title' => 'gezond broodje', 'advertisement_text' => 'met verse groenten en hummus', 'expires_at' => '2026-01-10 00:00:00', 'advert_type' => 'sale'],
            ['id' => 14, 'user_id' => 1, 'price' => 10.00, 'title' => 'kinder broodje', 'advertisement_text' => 'speciaal voor de kleintjes', 'expires_at' => '2026-02-05 00:00:00', 'advert_type' => 'sale'],
            ['id' => 15, 'user_id' => 3, 'price' => 9.00, 'title' => 'luxe broodje', 'advertisement_text' => 'met zalm en kaviaar', 'expires_at' => '2026-03-01 00:00:00', 'advert_type' => 'sale'],
            ['id' => 16, 'user_id' => 2, 'price' => 11.00, 'title' => 'speciaal broodje', 'advertisement_text' => 'met geheime ingrediënten', 'expires_at' => '2026-04-10 00:00:00', 'advert_type' => 'rental'],
            ['id' => 17, 'user_id' => 1, 'price' => 13.00, 'title' => 'feest broodje', 'advertisement_text' => 'voor elke gelegenheid', 'expires_at' => '2026-05-15 00:00:00', 'advert_type' => 'rental'],
            ['id' => 18, 'user_id' => 3, 'price' => 15.00, 'title' => 'verrassings broodje', 'advertisement_text' => 'je weet nooit wat je krijgt', 'expires_at' => '2026-06-20 00:00:00', 'advert_type' => 'rental'],
            ['id' => 19, 'user_id' => 5, 'price' => 10.00, 'title' => 'broodje', 'advertisement_text' => 'dit broodje is lekker', 'expires_at' => '2025-03-02 00:00:00', 'advert_type' => 'sale'],
            ['id' => 20, 'user_id' => 5, 'price' => 12.00, 'title' => 'lekkerder broodje', 'advertisement_text' => 'deze broodje grote lekker', 'expires_at' => '2025-03-02 00:00:00', 'advert_type' => 'sale'],
            ['id' => 21, 'user_id' => 5, 'price' => 14.00, 'title' => 'carpacio broodje', 'advertisement_text' => 'deze broodje grote lekker met vlees', 'expires_at' => '2025-03-02 00:00:00', 'advert_type' => 'sale'],
            ['id' => 22, 'user_id' => 5, 'price' => 10.00, 'title' => 'broodje', 'advertisement_text' => 'dit broodje is lekker', 'expires_at' => '2025-03-02 00:00:00', 'advert_type' => 'sale'],
            ['id' => 23, 'user_id' => 5, 'price' => 12.00, 'title' => 'lekkerder broodje', 'advertisement_text' => 'deze broodje grote lekker', 'expires_at' => '2025-03-02 00:00:00', 'advert_type' => 'sale'],
            ['id' => 24, 'user_id' => 5, 'price' => 14.00, 'title' => 'carpacio broodje', 'advertisement_text' => 'deze broodje grote lekker met vlees', 'expires_at' => '2025-03-02 00:00:00', 'advert_type' => 'sale'],
            
            

        ]);
        DB::table('rentals')->insert([
            ['id' => 1, 'advert_id' => 16, 'renter_id' => 5, 'start_date' => '2025-03-02 00:00:00', 'end_date' => '2025-03-09 00:00:00'],
            ['id' => 2, 'advert_id' => 17, 'renter_id' => 5, 'start_date' => '2025-03-02 00:00:00', 'end_date' => '2025-03-09 00:00:00'],
            ['id' => 3, 'advert_id' => 18, 'renter_id' => 5, 'start_date' => '2025-03-02 00:00:00', 'end_date' => '2025-03-09 00:00:00'],
        ]);
        DB::table('companies')->insert([
            [
                'id' => 1,
                'owner_id' => 1,
                'custom_url' => 'jumbo',  
                'api_enabled' => 1,
                'intro' => 'Jumbo is een supermarkt',
                'phone' => 123456789,
                'email' => 'jumbo@jumbo.nl',
                'address' => 'straat',
                'city' => 'stad',
                'country' => 'land',
                'postal_code' => '1234AB',
                'intro_component' => 0,
                'contact_component' => 0,
                'qr_code_component' => 0
                         
            ],
            [
                'id' => 2,
                'owner_id' => 2,
                'custom_url' => 'appie',
                'api_enabled' => 1,
                'intro' => 'Albert Heijn is een supermarkt',
                'phone' => 987654321,
                'email' => 'appie@appie.nl',
                'address' => 'straat',
                'city' => 'stad',
                'country' => 'land',
                'postal_code' => '4321BA',
                'intro_component' => 1,
                'contact_component' => 1,
                'qr_code_component' => 1
            ],
        ]);
    }

}
