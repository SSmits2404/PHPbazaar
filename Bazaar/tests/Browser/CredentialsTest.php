<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use function PHPSTORM_META\type;

class CredentialsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', 'Dusk')
                ->type('email', 'dusk@dusk.com')
                ->type('password', 'Dusk24!12')
                ->type('password_confirmation', 'Dusk24!12')
                ->click('button[type="submit"]')
                ->assertPathIs('/dashboard')
                ->visit('/profile')
                ->click('#delete-user-button')
                ->type('password2', 'Dusk24!12')
                ->click('#confirm-delete');


        });
    }
}
