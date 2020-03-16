<?php

namespace App;

use App\Category;
use App\CategoryProduct;
use App\Scopes\WithCategoryScope;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\WithProductAttributesScope;

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
