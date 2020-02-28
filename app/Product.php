<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
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
     * Additional attributes to load.
     *
     * @var array
     */
    protected static $additionalAttributes = [
        84 => 'meta_title',
        86 => 'meta_description',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        $additionalAttributes = static::$additionalAttributes;
        static::addGlobalScope('attributes', function (Builder $builder) use ($additionalAttributes) {
            $builder->select($builder->getQuery()->from.'.*');
            foreach ($additionalAttributes as $attributeId => $attributeCode) {
                $builder
                    ->addSelect($attributeCode.'.value AS '.$attributeCode)
                    ->leftJoin(
                        'catalog_product_entity_varchar AS '.$attributeCode,
                        function ($join) use ($builder, $attributeId, $attributeCode) {
                            $join->on($attributeCode.'.entity_id', '=', $builder->getQuery()->from.'.entity_id')
                                 ->where($attributeCode.'.attribute_id', $attributeId);
                        }
                    );
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
