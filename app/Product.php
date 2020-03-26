<?php

namespace App;

use App\Scopes\WithProductAttributesScope;
use App\Scopes\WithProductCategoryIdsScope;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'entity_id';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WithProductAttributesScope);
        static::addGlobalScope(new WithProductCategoryIdsScope);
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return 'catalog_product_flat_' . config('shop.store');
    }
}
