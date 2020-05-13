<?php

namespace Extensions\Compare;

use App\Product;
use App\Scopes\WithProductCategoryIdsScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CompareExtensionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'compare-extension');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/compare-extension'),
        ], 'views');

        View::composer(['category', 'compare-extension::overview'], function ($view) {
            if ($productIds = session('compare')) {
                $products = $this->getComparedProductsArray($productIds);
            }

            config(['frontend.compare' => $products ?? []]);
        });

        Route::middleware('web')->group(function () {
            Route::get('compare', function () {
                return view('compare-extension::overview');
            });

            Route::post('compare', function (Request $request) {
                abort_unless(Product::find($request->product), 404);
                $request->session()->push('compare', $request->product);
                return $this->getComparedProductsArray($request->session()->get('compare'));
            })->name('compare.store');

            Route::delete('compare/{product}', function (Request $request, $product) {
                $compare = $request->session()->get('compare');
                $compare = array_values(array_filter($compare, fn ($id) => $id != $product));
                $request->session()->put('compare', $compare);
                return $this->getComparedProductsArray($compare);
            })->name('compare.destroy');
        });
    }

    protected function getComparedProductsArray(array $productIds): array
    {
        return Product::byIds($productIds)
            ->withoutGlobalScope(WithProductCategoryIdsScope::class)
            ->selectOnlyComparable()
            ->get()
            ->keyBy('id')
            ->toArray();
    }
}
