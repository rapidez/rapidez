<?php

namespace Extensions\Compare;

use App\Product;
use App\Scopes\WithProductCategoryIdsScope;
use Extensions\ExtensionInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class CompareExtension implements ExtensionInterface
{
    public function boot()
    {
        View::composer(['category', 'compare'], function ($view) {
            if ($productIds = session('compare')) {
                $products = $this->getComparedProductsArray($productIds);
            }

            $view->getFactory()->startPush('variables', 'window.shop.compare = '.json_encode($products ?? []).';');
        });

        Route::middleware('web')->group(function () {
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
            ->onlyComparable()
            ->get()
            ->keyBy('id')
            ->toArray();
    }
}
