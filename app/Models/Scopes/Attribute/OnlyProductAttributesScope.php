<?php

namespace App\Models\Scopes\Attribute;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\DB;

class OnlyProductAttributesScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder
                ->selectRaw('
                    eav_attribute.attribute_id AS id,
                    IFNULL(value, attribute_code) AS name,
                    attribute_code AS code,
                    backend_type AS type,
                    frontend_input AS input,
                    IF(attribute_code IN ("price", "tax_class_id"), 0, is_searchable) AS search,
                    is_filterable AS filter,
                    is_comparable AS compare,
                    used_in_product_listing AS listing,
                    used_for_sort_by AS sorting,
                    is_visible_on_front AS productpage,
                    GREATEST(
                        IF(backend_type = "static", 1, 0),
                        is_used_for_promo_rules,
                        used_in_product_listing,
                        used_for_sort_by,
                        IF(attribute_code IN ("status", "required_options", "tax_class_id", "weight"), 1, 0)
                    ) AS flat,
                    EXISTS(
                        SELECT 1
                        FROM catalog_product_super_attribute
                        WHERE catalog_product_super_attribute.attribute_id = eav_attribute.attribute_id
                    ) AS super,
                    additional_data->>"$.swatch_input_type" = "text" AS text_swatch,
                    additional_data->>"$.swatch_input_type" = "visual" AS visual_swatch
                ')
                ->join('catalog_eav_attribute', 'eav_attribute.attribute_id', '=', 'catalog_eav_attribute.attribute_id')
                ->leftJoin('eav_attribute_label', function ($join) {
                    $join->on('eav_attribute.attribute_id', '=', 'eav_attribute_label.attribute_id')
                         ->where('store_id', config('shop.store'));
                })
                ->where('entity_type_id', 4); // catalog_product
    }
}
