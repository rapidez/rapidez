<?php

namespace Extensions\Variants;

use Extensions\ExtensionInterface;
use Extensions\Variants\Scopes\WithProductVariantsScope;
use TorMorten\Eventy\Facades\Eventy;

class VariantExtension implements ExtensionInterface
{
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
