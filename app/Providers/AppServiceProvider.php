<?php

namespace App\Providers;

use App\Models\Attribute;
use App\Models\Config;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(['frontend' => Arr::only(config('shop'), config('shop.exposed'))]);

        config(['frontend.cart' => null]);

        config(['frontend.locale' => Config::getCachedByPath('general/locale/code')]);
        config(['frontend.currency' => Config::getCachedByPath('currency/options/default')]);

        config(['frontend.searchable' => Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
            return $attribute['search'];
        }), 'code')]);
    }
}
