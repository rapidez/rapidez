<?php

namespace App\Providers;

use Rapidez\Core\Models\Attribute;
use Rapidez\Core\Models\Config;
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
            $exposedFrontendConfigValues = Arr::only(
                config('rapidez'),
                array_merge(config('rapidez.exposed'), ['store_code'])
            );

            config(['frontend' => array_merge(
                config('frontend') ?: [],
                $exposedFrontendConfigValues
            )]);

            config(['frontend.locale' => Config::getCachedByPath('general/locale/code', 'en_US')]);
            config(['frontend.currency' => Config::getCachedByPath('currency/options/default')]);

            config(['frontend.searchable' => Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
                return $attribute['search'];
            }), 'code')]);
        });
    }
}
