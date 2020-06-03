<?php

namespace App\Casts;

use App\Models\OptionValue;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Multiselect implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        if ($value) {
            foreach (explode(',', $value) as $optionValueId) {
                $values[] = OptionValue::getCachedByOptionId($optionValueId);
            }
            return $values;
        }

        return $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}
