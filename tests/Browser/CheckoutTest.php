<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CheckoutTest extends DuskTestCase
{
    public function testCheckoutAsGuest()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->testProduct->url_key)
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->click('@add-to-cart')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->visit('/checkout')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->type('@email', 'test@test.nl')
                    ->click('@continue')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->pause(3000);

            // TODO...
        });
    }
}
