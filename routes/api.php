<?php

use App\Models\Attribute;
use App\Models\OptionValue;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('attributes', function () {
    return Attribute::getCachedWhere(function ($attribute) {
        return $attribute['filter'] || $attribute['sorting'];
    });
});

Route::get('cart/{mask}', function ($mask) {
    $superAttributes = Arr::pluck(Attribute::getCachedWhere(function ($attribute) {
        return $attribute['super'];
    }), 'code', 'id');

    $result = DB::table('quote_id_mask')
        ->select([
            'quote_id_mask.quote_id',
            'items_count',
            'items_qty',
        ])
        ->selectRaw('
            ANY_VALUE(quote_address.subtotal_incl_tax) as subtotal,
            ANY_VALUE(quote_address.tax_amount) as tax,
            ANY_VALUE(quote_address.grand_total) as total
        ')
        ->selectRaw('JSON_OBJECTAGG(quote_item.item_id, JSON_OBJECT(
            "item_id", quote_item.item_id,
            "product_id", quote_item.product_id,
            "sku", quote_item.sku,
            "name", quote_item.name,
            "image", product.thumbnail,
            "url", product.url_key,
            "qty", quote_item.qty,
            "price", quote_item.price_incl_tax,
            "total", quote_item.row_total_incl_tax,
            "attributes", quote_item_option.value
        )) AS items')
        ->where('masked_id', $mask)
        ->join('quote', 'quote.entity_id', '=', 'quote_id_mask.quote_id')
        ->leftJoin('quote_address', function ($join) {
            $join->on('quote_address.quote_id', '=', 'quote_id_mask.quote_id')->where('address_type', 'shipping');
        })
        ->leftJoin('quote_item', function ($join) {
            $join->on('quote_item.quote_id', '=', 'quote_id_mask.quote_id')->whereNull('parent_item_id');
        })
        ->leftJoin('quote_item_option', function ($join) {
            $join->on('quote_item.item_id', '=', 'quote_item_option.item_id')->where('code', 'attributes');
        })
        ->join('catalog_product_flat_'.config('shop.store').' AS product', 'product.entity_id', '=', 'quote_item.product_id')
        ->groupBy('quote_id_mask.quote_id')
        ->first();

    $result->items = json_decode($result->items);

    foreach ($result->items as $item) {
        $options = null;
        foreach (json_decode($item->attributes) ?: [] as $attributeId => $attributeValue) {
            $options[$superAttributes[$attributeId]] = OptionValue::getCachedByOptionId($attributeValue);
        }
        $item->options = $options;
        unset($item->attributes);
    }

    return (array)$result;
});
