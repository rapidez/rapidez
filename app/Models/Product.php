<?php

namespace App\Models;

use App\Models\Model;
use App\Models\Traits\Product\CastSuperAttributes;
use App\Models\Traits\Product\SelectAttributeScopes;
use App\Scopes\WithProductAttributesScope;
use App\Scopes\WithProductCategoryIdsScope;
use App\Scopes\WithProductSuperAttributesScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use TorMorten\Eventy\Facades\Eventy;

class Product extends Model
{
    use CastSuperAttributes, SelectAttributeScopes;

    public array $attributesToSelect = [];

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

    public function getCategoryIdsAttribute(string $value): array
    {
        return explode(',', $value);
    }

    public static function exist($productId): bool
    {
        return self::withoutGlobalScopes()->where('entity_id', $productId)->exists();
    }
}
