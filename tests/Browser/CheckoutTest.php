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
            $browser->visit($this->testProduct->url)
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->click('@add-to-cart')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->visit('/checkout')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->type('@email', config('testing.guest'))
                    ->click('@continue')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->click('@continue')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->click('@method-0', 5)
                    ->click('@continue')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->assertSee('Partytime!');
        });
    }

    public function testCheckoutAsUser()
    {
        if (!config('testing.pass')) {
            $this->markTestSkipped('No password for the test user specified.');
        }

        $this->browse(function (Browser $browser) {
            $browser->visit($this->testProduct->url)
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->click('@add-to-cart')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->visit('/checkout')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->type('@email', config('testing.user'))
                    ->click('@continue')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->type('@password', config('testing.pass'))
                    ->click('@continue')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->click('@continue')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->click('@method-0', 5)
                    ->click('@continue')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->assertSee('Partytime!');
        });
    }
}
