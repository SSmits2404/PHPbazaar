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
                ->type('name', 'Dusk2')
                ->type('email', 'dusk2@dusk.com')
                ->type('password', 'Dusk24!21')
                ->type('password_confirmation', 'Dusk24!21')
                ->click('button[type="submit"]')
                ->assertPathIs('/dashboard')
                ->click('#navbardropdown')
                ->click('#logout')
                ->pause(5000);



                
            
                // ->type('email', 'root@root.nl')
                // ->assertSee('Email')
                // ->type('email', 'root@root.nl')
                // ->type('password', 'root')
                // ->click('button[type="submit"]')
                // ->assertPathIs('/dashboard')
                // ->visit('/profile')
                // ->type('name', 'root2')
                // ->click('button[type="submit"]')
                // ->pause(1000);


        });
    }
}
