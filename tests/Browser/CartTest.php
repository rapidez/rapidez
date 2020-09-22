<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CartTest extends DuskTestCase
{
    public function testAddSimpleProduct()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->testProduct->url_key)
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->click('@add-to-cart')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->visit('/cart')
                    ->assertSee($this->testProduct->name);
        });
    }

    public function testChangeProductQty()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/cart')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->type('@qty-0', 5)
                    ->click('@item-update-0')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->assertSee($this->testProduct->price * 5);
        });
    }

    public function testRemoveProduct()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/cart')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->click('@item-delete-0')
                    ->waitUntilAllAjaxCallsAreFinished()
                    ->assertDontSee($this->testProduct->name);
        });
    }
}
