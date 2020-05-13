<?php

namespace App\Scopes;

use App\Attribute;
use App\Exceptions\NoAttributesToSelectSpecifiedException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class WithProductAttributesScope implements Scope
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
        if (empty($model->attributesToSelect)) {
            throw NoAttributesToSelectSpecifiedException::create();
        }

        $attributes = Attribute::getCachedWhere(function ($attribute) use ($model) {
            return in_array($attribute['code'], $model->attributesToSelect);
        });

        $attributes = array_filter($attributes, fn ($a) => $a['type'] !== 'static');

        $builder
            ->select($builder->getQuery()->from.'.entity_id AS id')
            ->addSelect('sku');

        foreach ($attributes as $attribute) {
            $attribute = (object)$attribute;

            if ($attribute->flat) {
                if ($attribute->input == 'select' && !in_array($attribute->code, ['tax_class_id'])) {
                    $builder->addSelect($attribute->code.'_value AS '.$attribute->code);
                } else {
                    $builder->addSelect($builder->getQuery()->from.'.'.$attribute->code.' AS '.$attribute->code);
                }
            } else {
                // TODO: When it's a select we've to get the actual value.
                $builder
                    ->selectRaw('COALESCE('.$attribute->code.'_'.config('shop.store').'.value, '.$attribute->code.'_0.value) AS '.$attribute->code)
                    ->leftJoin(
                        'catalog_product_entity_'.$attribute->type.' AS '.$attribute->code.'_'.config('shop.store'),
                        function ($join) use ($builder, $attribute) {
                            $join->on($attribute->code.'_'.config('shop.store').'.entity_id', '=', $builder->getQuery()->from.'.entity_id')
                                 ->where($attribute->code.'_'.config('shop.store').'.attribute_id', $attribute->id)
                                 ->where($attribute->code.'_'.config('shop.store').'.store_id', config('shop.store'));
                        }
                    )->leftJoin(
                        'catalog_product_entity_'.$attribute->type.' AS '.$attribute->code.'_0',
                        function ($join) use ($builder, $attribute) {
                            $join->on($attribute->code.'_0.entity_id', '=', $builder->getQuery()->from.'.entity_id')
                                 ->where($attribute->code.'_0.attribute_id', $attribute->id)
                                 ->where($attribute->code.'_0.store_id', 0);
                        }
                    );
            }
        }
    }
}
