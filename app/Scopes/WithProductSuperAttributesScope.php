<?php

namespace App\Scopes;

use App\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class WithProductSuperAttributesScope implements Scope
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
        $superAttributes = Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
            return $attribute['super'];
        }), 'code');

        foreach ($superAttributes as $superAttribute) {
            $query = DB::table('catalog_product_super_link')
                ->selectRaw('JSON_OBJECTAGG('.$superAttribute.', '.$superAttribute.'_value) AS '.$superAttribute)
                ->join('catalog_product_flat_1 AS children', 'children.entity_id', '=', 'catalog_product_super_link.product_id')
                ->whereColumn('parent_id', $model->getTable() . '.entity_id')
                ->whereNotNull($superAttribute);

            $builder->selectSub($query, $superAttribute);
        }

        $query = DB::table('catalog_product_super_attribute')
            ->selectRaw('JSON_OBJECTAGG(eav_attribute.attribute_id, COALESCE(NULLIF(value, ""), frontend_label)) AS super_attributes')
            ->join('eav_attribute', 'eav_attribute.attribute_id', '=', 'catalog_product_super_attribute.attribute_id')
            ->leftJoin('catalog_product_super_attribute_label', function ($join) {
                $join
                    ->on('catalog_product_super_attribute_label.product_super_attribute_id', '=', 'catalog_product_super_attribute.product_super_attribute_id')
                    ->where('catalog_product_super_attribute_label.store_id', config('shop.store'));
            })
            ->whereColumn('product_id', $model->getTable() . '.entity_id')
            ->orderBy('position');

        $builder->selectSub($query, 'super_attributes');
    }
}
