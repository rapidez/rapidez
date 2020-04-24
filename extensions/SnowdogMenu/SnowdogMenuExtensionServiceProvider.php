<?php

namespace Extensions\SnowdogMenu;

use Extensions\SnowdogMenu\Models\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
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

        Route::middleware('api')->prefix('api')->group(function () {
            Route::get('menu/{identifier}', function ($identifier) {
                return Cache::rememberForever('snowdogmenu.'.$identifier, function () use ($identifier) {
                    $menu = Menu::where('identifier', $identifier)->firstOrFail();
                    return view('snowdogmenu-extension::menu', [
                        'items' => $this->convertToMenuTree($menu->items),
                    ])->render();
                });
            });
        });
    }

    protected function convertToMenuTree($items, $parentId = null)
    {
        return $items->where('parent_id', $parentId)->map(function ($item) use ($items) {
            $item['children'] = $this->convertToMenuTree($items, $item->node_id);
            return $item;
        })->sortBy('position');
    }
}
