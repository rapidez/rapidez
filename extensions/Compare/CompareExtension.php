<?php

namespace Extensions\Compare;

use App\Product;
use Extensions\ExtensionInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class CompareExtension implements ExtensionInterface
{
    public function boot()
    {
        View::composer('layouts.app', function ($view) {
            $view->with('compare', session('compare'));
            $view->getFactory()->startPush('variables', 'window.compare = '.json_encode(session('compare', [])).';');
        });

        Route::middleware('web')->group(function () {
            Route::post('compare', function (Request $request) {
                abort_unless(Product::find($request->product), 404);
                $request->session()->push('compare', $request->product);
                return ['succes' => true];
            })->name('compare.store');

            Route::delete('compare/{product}', function (Request $request, $product) {
                $compare = $request->session()->get('compare');
                $compare = array_values(array_filter($compare, fn ($id) => $id != $product));
                $request->session()->put('compare', $compare);
                return ['succes' => true];
            })->name('compare.destroy');
        });
    }
}
