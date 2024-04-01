<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class navtest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser
            ->loginAs(User::find(1))
            ->visit('/dashboard')
            ->visit('/c')
            ->visit('/c/jumbo')
            ->visit('/');

        });
    }
}
