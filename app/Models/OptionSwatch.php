<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class OptionSwatch extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eav_attribute_option_swatch';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'swatch_id';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'values' => 'array',
    ];

    public static function getCachedSwatchValues(): array
    {
        $swatchAttributes = Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
            return $attribute['text_swatch'] || $attribute['visual_swatch'];
        }), 'id', 'code');

        return Cache::rememberForever('swatchvalues', function () use ($swatchAttributes) {
            return self::select('eav_attribute.attribute_code')
                ->selectRaw('JSON_OBJECTAGG(COALESCE(`eav_attribute_option_value_store`.`value`, `eav_attribute_option_value`.`value`), `eav_attribute_option_swatch`.`value`) as `values`')
                ->join('eav_attribute_option', function ($query) use ($swatchAttributes) {
                    $query->on('eav_attribute_option.option_id', '=', 'eav_attribute_option_swatch.option_id')
                        ->whereIn('eav_attribute_option.attribute_id', $swatchAttributes);
                })
                ->join('eav_attribute_option_value as eav_attribute_option_value_store', function ($query) use ($swatchAttributes) {
                    $query->on('eav_attribute_option.option_id', '=', 'eav_attribute_option_value_store.option_id')
                        ->whereIn('eav_attribute_option.attribute_id', $swatchAttributes)
                        ->where('eav_attribute_option_value_store.store_id', '=', config('shop.store'));
                })
                ->join('eav_attribute_option_value', function ($query) use ($swatchAttributes) {
                    $query->on('eav_attribute_option.option_id', '=', 'eav_attribute_option_value.option_id')
                        ->whereIn('eav_attribute_option.attribute_id', $swatchAttributes)
                        ->where('eav_attribute_option_value.store_id', '=', 0);
                })
                ->join('eav_attribute', 'eav_attribute.attribute_id', '=', 'eav_attribute_option.attribute_id')
                ->whereNotNull('eav_attribute_option_swatch.value')
                ->groupBy('eav_attribute.attribute_code')
                ->distinct()
                ->get()
                ->keyBy('attribute_code')
                ->toArray();
        });
    }
}
