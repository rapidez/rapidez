<?php

namespace Extensions\SnowdogMenu;

use Extensions\SnowdogMenu\ViewComponents\SnowdogMenuComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SnowdogMenuExtensionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'snowdogmenu-extension');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/snowdogmenu-extension'),
        ], 'views');

        $this->mergeConfigFrom(__DIR__.'/config/snowdogmenu-extension.php', 'snowdogmenu-extension');

        $this->publishes([
            __DIR__.'/config/snowdogmenu-extension.php' => config_path('snowdogmenu-extension.php'),
        ], 'config');

        Blade::component('snowdog-menu', SnowdogMenuComponent::class);
    }
}
