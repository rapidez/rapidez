<?php

namespace App;

use App\Scopes\WithProductAttributesScope;
use App\Scopes\WithProductCategoryIdsScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Product extends Model
{
    public $attributesToSelect = [];

    protected $primaryKey = 'entity_id';

    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new WithProductAttributesScope);
        static::addGlobalScope(new WithProductCategoryIdsScope);
    }

    public function getTable(): string
    {
        return 'catalog_product_flat_' . config('shop.store');
    }

    public function scopeByIds(Builder $query, array $productIds): Builder
    {
        return $query->whereIn($this->getTable().'.entity_id', $productIds);
    }

    public function scopeOnlyComparable(Builder $query): Builder
    {
        $this->attributesToSelect = Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
            return $attribute['compare'] || in_array($attribute['code'], ['name']);
        }), 'code');

        return $query;
    }
}
