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
                'name'=> 'admin',
                'email'=> 'admin@admin.com',
                'password'=> bcrypt('admin'),
                'role'=> 'admin'
            ],
            [
                'id'=> 4,
                'name'=> 'company',
                'email'=> 'company@company.com',
                'password'=> bcrypt('company'),
                'role'=> 'company'
            ],
            [
                'id'=> 5,
                'name'=> 'company2',
                'email'=> 'company2@company.com',
                'password'=> bcrypt('company2'),
                'role'=> 'company'
            ]
        ]);

        // Then insert adverts
        DB::table('adverts')->insert([


            ['id' => 1,'user_id' => 4,'price' => 8.00,'title' => 'broodje','advertisement_text' => 'dit broodje is lekker','expires_at' => '2025-03-02 00:00:00','bid' => null,'advert_type' => 'sale' , 'base_durability' =>null, 'durability' => null, 'wear' => null],
            ['id' => 2,'user_id' => 4,'price' => 12.00,'title' => 'lekkerder broodje','advertisement_text' => 'deze broodje grote lekker','expires_at' => '2025-03-02 00:00:00','bid' => null,'advert_type' => 'sale' , 'base_durability' =>null, 'durability' => null, 'wear' => null],
            ['id' => 3, 'user_id' => 4, 'price' => 14.00, 'title' => 'carpacio broodje','advertisement_text' => 'deze broodje grote lekker met vlees', 'expires_at' => '2025-03-02 00:00:00','bid' => null, 'advert_type' => 'sale' , 'base_durability' =>null, 'durability' => null, 'wear' => null],
            ['id' => 4, 'user_id' => 4, 'price' => 10.00, 'title' => 'vegan broodje', 'advertisement_text' => '100% plantaardig broodje', 'expires_at' => '2025-04-01 00:00:00','bid' => null, 'advert_type' => 'rental', 'base_durability' =>10, 'durability' => 10, 'wear' => 1],
            ['id' => 5, 'user_id' => 4, 'price' => 9.50, 'title' => 'kaas broodje', 'advertisement_text' => 'broodje met oude kaas', 'expires_at' => '2025-05-05 00:00:00','bid' => null, 'advert_type' => 'rental',  'base_durability' =>10, 'durability' => 1, 'wear' => 1],
            ['id' => 6, 'user_id' => 4, 'price' => 15.00, 'title' => 'deluxe broodje', 'advertisement_text' => 'luxe broodje met exclusieve ingrediënten', 'expires_at' => '2025-06-10 00:00:00','bid' => null, 'advert_type' => 'rental',  'base_durability' =>10, 'durability' => 0, 'wear' => 1],
            ['id' => 7, 'user_id' => 4, 'price' => 11.00, 'title' => 'italiaans broodje', 'advertisement_text' => 'italiaanse kruiden en mozzarella', 'expires_at' => '2025-07-20 00:00:00','bid' => 0.0, 'advert_type' => 'auction', 'base_durability' =>null, 'durability' => null, 'wear' => null],
            ['id' => 8, 'user_id' => 4, 'price' => 13.00, 'title' => 'kruidig broodje', 'advertisement_text' => 'met pikante kip en speciale saus', 'expires_at' => '2025-08-15 00:00:00','bid' => 0.0, 'advert_type' => 'auction', 'base_durability' =>null, 'durability' => null, 'wear' => null],
            ['id' => 9, 'user_id' => 4, 'price' => 7.50, 'title' => 'eenvoudig broodje', 'advertisement_text' => 'simpel maar heerlijk broodje ham', 'expires_at' => '2025-09-05 00:00:00','bid' => 0.0, 'advert_type' => 'auction', 'base_durability' =>null, 'durability' => null, 'wear' => null],

            
            

        ]);
        DB::table('rentals')->insert([
            ['id' => 1, 'advert_id' => 6, 'renter_id' => 1, 'start_date' => '2024-03-02 00:00:00', 'end_date' => '2025-03-09 00:00:00', 'picked_up' => false, 'available'=> true],
            ['id' => 2, 'advert_id' => 5, 'renter_id' => 2, 'start_date' => '2024-03-02 00:00:00', 'end_date' => '2025-03-09 00:00:00', 'picked_up' => true, 'available'=> true],
            ['id' => 3, 'advert_id' => 4, 'renter_id' => 3, 'start_date' => '2024-03-02 00:00:00', 'end_date' => '2025-03-09 00:00:00', 'picked_up' => false, 'available'=> false],
  
        ]);
        DB::table('companies')->insert([
            [
                'id' => 1,
                'owner_id' => 4,
                'custom_url' => 'avans',  
                'api_enabled' => 1,
                'intro' => 'Avans is een hogeschool',
                'phone' => 612345678,
                'email' => 'avans@denbosch.nl',
                'address' => 'onderwijsboulevard 215a',
                'city' => 'den bosch',
                'country' => 'Nederland',
                'postal_code' => '5223DE',
                'intro_component' => 0,
                'contact_component' => 0,
                'qr_code_component' => 0
                         
            ],
            [
                'id' => 2,
                'owner_id' => 5,
                'custom_url' => 'spar',
                'api_enabled' => 1,
                'intro' => 'Spar is een supermarkt',
                'phone' => 687654321,
                'email' => 'spar@spar.nl',
                'address' => 'Hoofdtraat 37',
                'city' => 'Genderen',
                'country' => 'Nederland',
                'postal_code' => '4265 HJ',
                'intro_component' => 1,
                'contact_component' => 1,
                'qr_code_component' => 1
            ],
        ]);
    }

}
