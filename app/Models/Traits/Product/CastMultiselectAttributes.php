<?php

namespace App\Models\Traits\Product;

use App\Casts\Multiselect;
use App\Models\Attribute;
use Illuminate\Support\Arr;

trait CastMultiselectAttributes
{
    protected function getMultiselectAttributeCasts(): array
    {
        $multiselectAttributes = Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
            return $attribute['input'] == 'multiselect';
        }), 'code');

        foreach ($multiselectAttributes as $multiselectAttribute) {
            $casts[$multiselectAttribute] = Multiselect::class;
        }

        return $casts;
    }
}
