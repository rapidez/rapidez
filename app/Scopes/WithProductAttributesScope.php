<?php

namespace App\Scopes;

use DB;
use Illuminate\Support\Facades\Cache;
use App\Attribute;
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
        // So i was debuggin this, and this doesn't work with small image.
        // Lets have a look together next week Roy :)

        $attributes = array_filter(Attribute::all()->toArray(), function($attribute) {
            return array_key_exists($attribute['code'], config('shop.attributes'));
        });

        // $attributes = Attribute::getCachedWhere(function ($attribute) {
        //     dump($attribute['code']);
        //     if ($attribute['code'] == 'small_image') {
        //         dd($attribute);
        //     }
        //     return array_key_exists($attribute['code'], config('shop.attributes'));
        // });

        $builder->select($builder->getQuery()->from.'.entity_id AS id');

        foreach ($attributes as $attribute) {
            $attribute = (object)$attribute;
            if ($attribute->flat) {
                // The attributes which are always present in the flat tables.
                if (in_array($attribute->code, config('shop.default_flat_attributes'))) {
                    $builder->addSelect(DB::raw('MAX('.$builder->getQuery()->from.'.'.$attribute->code.') AS '.$attribute->code));
                } else {
                    $builder->addSelect(DB::raw('MAX('.$builder->getQuery()->from.'.'.$attribute->code.'_value) AS '.$attribute->code));
                }
            // Uhmm maybe not the right way please teach me :)
            } elseif ($attribute->code == 'category_ids') {
                $builder
                    ->addSelect(DB::raw('GROUP_CONCAT(`cp`.`category_id`) as category_ids'))
                    ->join('catalog_category_product_index_store'.config('shop.store').' as cp', $model->getTable().'.entity_id', '=', 'cp.product_id')
                    ->groupBy($model->getTable().'.entity_id');
            } else {
                $builder
                    ->addSelect(DB::raw('MAX('.$attribute->code.'.value) AS '.$attribute->code))
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
    }
}
