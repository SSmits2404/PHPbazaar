<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class navtest extends DuskTestCase
{
     /**
     * @group nav
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser
            ->loginAs(User::find(1))
            ->visit('/dashboard')
            ->visit('/c')
            ->visit('/c/jumbo')
            ->visit('/adverts')
            ->visit('/adverts/create?type=rental')
            ->assertSee('creating advert type rental')
            ->visit('/adverts/create?type=sale')
            ->assertSee('creating advert type sale')
            ->visit('/adverts/create?type=auction')
            ->assertSee('creating advert type auction')
            ->visit('/adverts/1')
            ->assertSee('Vote')
            ->visit('/profile')
            ->assertSee('Save');

        });
    }
}
