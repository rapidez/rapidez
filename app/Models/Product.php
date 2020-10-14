<?php

namespace App\Models;

use App\Models\Config;
use App\Models\Model;
use App\Models\Scopes\Product\WithProductAttributesScope;
use App\Models\Scopes\Product\WithProductCategoryIdsScope;
use App\Models\Scopes\Product\WithProductSuperAttributesScope;
use App\Models\Traits\Product\CastMultiselectAttributes;
use App\Models\Traits\Product\CastSuperAttributes;
use App\Models\Traits\Product\SelectAttributeScopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use NumberFormatter;
use TorMorten\Eventy\Facades\Eventy;

class Product extends Model
{
    use CastSuperAttributes, CastMultiselectAttributes, SelectAttributeScopes;

    public array $attributesToSelect = [];

    protected $primaryKey = 'entity_id';

    protected $appends = ['formatted_price', 'url'];

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
            $this->getSuperAttributeCasts(),
            $this->getMultiselectAttributeCasts(),
            Eventy::filter('product.casts') ?: [],
        );
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

    public function getFormattedPriceAttribute(): string
    {
        $currency  = Config::getCachedByPath('currency/options/default');
        $locale    = Config::getCachedByPath('general/locale/code', 'en_US');
        $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($this->price, $currency);
    }

    public function getUrlAttribute(): string
    {
        return $this->url_key . Config::getCachedByPath('catalog/seo/product_url_suffix', '.html');
    }

    public static function exist($productId): bool
    {
        return self::withoutGlobalScopes()->where('entity_id', $productId)->exists();
    }
}
