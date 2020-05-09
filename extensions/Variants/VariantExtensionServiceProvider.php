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
        Eventy::addFilter('product.scopes', function () {
            return [WithProductVariantsScope::class];
        });

        Eventy::addFilter('product.casts', function () {
            return ['variants' => 'object'];
        });

        Eventy::addFilter('index.product.attributes', function () {
            return ['variants' => true];
        });
    }
}
