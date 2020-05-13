<?php

namespace App\Models\Traits\Product;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use TorMorten\Eventy\Facades\Eventy;

trait SelectAttributeScopes
{
    public function scopeSelectAttributes(Builder $query, array $attributes): Builder
    {
        $this->attributesToSelect = $attributes;

        return $query;
    }

    public function scopeSelectForProductPage(Builder $query): Builder
    {
        $this->attributesToSelect = Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
            return $attribute['productpage'] || in_array($attribute['code'], [
                'name',
                'meta_title',
                'meta_description',
                'price',
                'description',
            ]);
        }), 'code');

        return $query;
    }

    public function scopeSelectOnlyComparable(Builder $query): Builder
    {
        $this->attributesToSelect = Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
            return $attribute['compare'] || in_array($attribute['code'], ['name']);
        }), 'code');

        return $query;
    }

    public function scopeSelectOnlyIndexable(Builder $query): Builder
    {
        $this->attributesToSelect = Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
            if (in_array($attribute['code'], ['msrp_display_actual_price_type', 'price_view', 'shipment_type', 'status'])) {
                return false;
            }

            if ($attribute['listing'] || $attribute['filter']) {
                return true;
            }

            $alwaysInFlat = array_merge(['sku'], Eventy::filter('index.product.attributes') ?: []);
            if (in_array($attribute['code'], $alwaysInFlat)) {
                return true;
            }

            return false;
        }), 'code');

        return $query;
    }
}
