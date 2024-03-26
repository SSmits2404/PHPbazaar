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

            $browser->loginAs(User::find(1))
                ->visit('/')
                ->visit('/adverts')
                ->visit('/adverts/create')
                ->pause(1000)
                ->type('title', 'iodjwfoaifjwofjiaoefjwaoefijeawoifjwa')
                ->pause(1000)
                ->type('advertisement_text', 'This is a new advert')
                ->pause(1000)
                ->type('price', '8.00')	
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
                ->radio('#advert_type', 'Insta Sell')
                ->pause(1000)
                ->press('Create Advert')
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
