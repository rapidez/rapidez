<?php

namespace Extensions\Variants;

use Extensions\Variants\Scopes\WithProductVariantsScope;
use Illuminate\Support\ServiceProvider;
use TorMorten\Eventy\Facades\Eventy;

class VariantExtensionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Eventy::addFilter('index.product.scopes', function () {
            return [WithProductVariantsScope::class];
        });

        Eventy::addFilter('index.product.data', function ($data, $product) {
            $data['variants'] = $product->variants
                ? json_decode($product->variants)
                : null;
            return $data;
        }, 20, 2);
    }
}
