<?php

namespace App\Providers;

use Laravel\Dusk\Browser;
use Illuminate\Support\ServiceProvider;

class DuskServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Browser::macro('waitUntilAllAjaxCallsAreFinished', function () {
            $this->waitUntil('!window.app.$data.loading');
            return $this;
        });
    }
}
