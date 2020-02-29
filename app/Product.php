<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

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

        static::addGlobalScope('attributes', function (Builder $builder) {
            $attributes = Arr::where(Cache::rememberForever('attributes', function () {
                return Attribute::all()->toArray();
            }), function ($attribute) {
                return in_array($attribute['code'], config('shop.product.attributes'));
            });

            foreach ($attributes as $attribute) {
                $attribute = (object)$attribute;
                if ($attribute->flat) {
                    // The attributes which are always present in the flat tables.
                    if (in_array($attribute->code, ['name', 'description', 'sku', 'price'])) {
                        $builder->addSelect($attribute->code.' AS '.$attribute->code);
                    } else {
                        $builder->addSelect($attribute->code.'_value AS '.$attribute->code);
                    }
                } else {
                    $builder
                        ->addSelect($attribute->code.'.value AS '.$attribute->code)
                        ->leftJoin(
                            'catalog_product_entity_'.$attribute->type.' AS '.$attribute->code,
                            function ($join) use ($builder, $attribute) {
                                $join->on($attribute->code.'.entity_id', '=', $builder->getQuery()->from.'.entity_id')
                                     ->where($attribute->code.'.attribute_id', $attribute->id)
                                     ->where($attribute->code.'.store_id', config('shop.store'));
                            }
                        );
                }
            }
        });
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
