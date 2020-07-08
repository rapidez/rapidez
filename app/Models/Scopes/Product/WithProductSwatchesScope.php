<?php

namespace App\Scopes;

use DB;
use App\Models\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class WithProductSwatchesScope implements Scope
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
        $attributes = Attribute::getCachedWhere(function ($attribute) {
            return $attribute['text_swatch'] || $attribute['visual_swatch'];
        });

        foreach ($attributes as $attribute) {
            $attribute = (object)$attribute;

            $builder
                ->addSelect(
                    DB::raw('
                        COALESCE(
                            `swatch_store_'.$attribute->code.'`.`value`,
                            `swatch_'.$attribute->code.'`.`value`
                        ) as `'.$attribute->code.'_swatch`
                    ')
                )
                ->leftJoin('eav_attribute_option_swatch as swatch_'.$attribute->code, function ($join) use ($attribute) {
                    $join->on('swatch_'.$attribute->code.'.option_id', '=', $attribute->code)
                         ->where('swatch_'.$attribute->code.'.store_id', 0);
                })
                ->leftJoin('eav_attribute_option_swatch as swatch_store_'.$attribute->code, function ($join) use ($attribute) {
                    $join->on('swatch_store_'.$attribute->code.'.option_id', '=', $attribute->code)
                         ->where('swatch_store_'.$attribute->code.'.store_id', config('shop.store'));
                });
        }
    }
}
