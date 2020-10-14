<?php

namespace Extensions\Menu;

use Extensions\Menu\ViewComponents\MenuComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MenuExtensionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'menu-extension');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/menu-extension'),
        ], 'views');

        $this->mergeConfigFrom(__DIR__.'/config/menu-extension.php', 'menu-extension');

        $this->publishes([
            __DIR__.'/config/menu-extension.php' => config_path('menu-extension.php'),
        ], 'config');

        Blade::component('menu', MenuComponent::class);
    }
}
