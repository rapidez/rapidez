<?php

namespace App\Providers;

use App\Models\Attribute;
use App\Models\Config;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
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
        View::composer('layouts.app', function ($view) {
            config(['frontend' => Arr::only(config('shop'), array_merge(config('shop.exposed'), ['store_code']))]);

            config(['frontend.locale' => Config::getCachedByPath('general/locale/code')]);
            config(['frontend.currency' => Config::getCachedByPath('currency/options/default')]);

            config(['frontend.searchable' => Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
                return $attribute['search'];
            }), 'code')]);
        });
    }
}
