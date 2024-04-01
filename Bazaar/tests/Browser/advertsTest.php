<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Advert;

class advertsTest extends DuskTestCase
{

    /**
     * @group adverts
     */

     
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {

            // Create a new user on the db to use 
            $user = new User();
            $user->name = 'goeiagjeogijwogwij';
            $user->email = 'a@b.com';
            $user->password = bcrypt('password');
            $user->role = 'advertiser';
            $user->save();

            $browser->loginAs(User::where('name', 'goeiagjeogijwogwij')->first())
                ->visit('/')
                ->visit('/adverts')
                ->visit('/adverts/create?advert_type=sale')
                ->pause(1000)
                ->type('title', 'iodjwfoaifjwofjiaoefjwaoefijeawoifjwa')
                ->pause(1000)
                ->type('advertisement_text', 'This is a new advert')
                ->pause(1000)
                ->type('#price', '8.00')	
                ->pause(1000)
                ->keys('#expiry_moment',
                ['{arrow_up}'],
                ['{arrow_right}'],
                ['{arrow_up}'], // Navigate in the picker (this is speculative)
                ['{arrow_right}'],
                ['{arrow_up}'],
                ['{arrow_right}'],
                ['{arrow_up}'],
                ['{arrow_right}'], // Increase value (e.g., hours)
                ['{arrow_up}'],
                ['{arrow_right}'],
                ['{arrow_up}'],
                ['{arrow_right}'], // Increase value (e.g., minutes)
                ['{tab}'],
                // ...continue as needed to set the desired date and time
                ['tab'] // Move out of the datetime field, potentially necessary to trigger change events
                )
                ->pause(1000)
                ->press('#submit')
                ->assertPathIs('/adverts');
            // Clean up after the tests
            
        });

        // Check if the advert was created in the database
        $advert = Advert::where('title', 'iodjwfoaifjwofjiaoefjwaoefijeawoifjwa')->first();
        $this->assertNotNull($advert);

        // Delete the advert from the database
        $advert->delete();

    }
}
