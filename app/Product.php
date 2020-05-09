<?php

namespace App;

use App\Model;
use App\Scopes\WithProductAttributesScope;
use App\Scopes\WithProductCategoryIdsScope;
use App\Scopes\WithProductSuperAttributesScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use TorMorten\Eventy\Facades\Eventy;

class Product extends Model
{
    public $attributesToSelect = [];

    protected $primaryKey = 'entity_id';

    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new WithProductAttributesScope);
        static::addGlobalScope(new WithProductSuperAttributesScope);
        static::addGlobalScope(new WithProductCategoryIdsScope);

        $scopes = Eventy::filter('product.scopes') ?: [];
        foreach ($scopes as $scope) {
            static::addGlobalScope(new $scope);
        }
    }

    public function getTable(): string
    {
        return 'catalog_product_flat_' . config('shop.store');
    }

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

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductImage::class,
            'catalog_product_entity_media_gallery_value_to_entity',
            'entity_id',
            'value_id',
            'id'
        );
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

    public function getCategoryIdsAttribute($value)
    {
        return explode(',', $value);
    }
}
