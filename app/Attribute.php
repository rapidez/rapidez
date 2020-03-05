<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eav_attribute';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'attribute_id';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('products-only', function (Builder $builder) {
            $builder
                ->selectRaw('
                    eav_attribute.attribute_id AS id,
                    value AS name,
                    attribute_code AS code,
                    backend_type AS type,
                    frontend_input AS input,
                    is_filterable AS filter,
                    GREATEST(is_searchable, is_visible_on_front, is_used_for_promo_rules, attribute_code IN ("image")) AS flat
                ')
                ->join('catalog_eav_attribute', 'eav_attribute.attribute_id', '=', 'catalog_eav_attribute.attribute_id')
                ->join('eav_attribute_label', function ($join) {
                    $join->on('eav_attribute.attribute_id', '=', 'eav_attribute_label.attribute_id')
                         ->where('store_id', config('shop.store'));
                })
                ->where('entity_type_id', 4); // catalog_product
        });
    }
}
