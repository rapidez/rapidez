<?php

namespace Extensions\ImageResizer;

use Extensions\ImageResizer\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ImageResizerExtensionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Route::middleware('web')->group(function () {
            Route::get('image/{size}/{file}', ImageController::class)->where('file', '.*');
        });

        $this->mergeConfigFrom(__DIR__.'/config/imageresizer-extension.php', 'imageresizer-extension');

        $this->publishes([
            __DIR__.'/config/imageresizer-extension.php' => config_path('imageresizer-extension.php'),
        ], 'config');
    }
}
