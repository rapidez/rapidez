<?php

namespace App\Providers;

use App\Attribute;
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

        config(['frontend.searchable' => Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
            return $attribute['search'];
        }), 'code')]);
    }
}
