<?php

namespace App\Casts;

use App\Models\Attribute;
use App\Models\Config;
use App\Models\OptionValue;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Arr;

class QuoteItems implements CastsAttributes
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
        // TODO: We're using the super attribute name but this can be overwritten
        // on product level. We're using that in WithProductSuperAttributesScope
        // which joins the catalog_product_super_attribute_label table.
        $superAttributes = Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
            return $attribute['super'];
        }), 'name', 'id');

        $items = json_decode($value);

        foreach ($items as $item) {
            $options = null;
            foreach (json_decode($item->attributes) ?: [] as $attributeId => $attributeValue) {
                $options[$superAttributes[$attributeId]] = OptionValue::getCachedByOptionId($attributeValue);
            }
            $item->options = $options;
            $item->url = '/' . $item->url_key . Config::getCachedByPath('catalog/seo/product_url_suffix', '.html');
            unset($item->attributes);
        }

        return $items;
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
