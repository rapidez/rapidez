<?php

namespace App\Models\Traits\Product;

use App\Models\Attribute;
use Illuminate\Support\Arr;

trait CastSuperAttributes
{
    public function getCasts(): array
    {
        return array_merge(
            parent::getCasts(),
            $this->getSuperAttributeCasts()
        );
    }

    protected function getSuperAttributeCasts(): array
    {
        $superAttributes = Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
            return $attribute['super'];
        }), 'code');

        foreach ($superAttributes as $superAttribute) {
            $casts[$superAttribute] = 'object';
        }

        $casts['super_attributes'] = 'object';

        return $casts;
    }
}
