<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ExtensionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (config('shop.extensions') as $extension) {
            (new $extension)->boot();
        }
    }
}
