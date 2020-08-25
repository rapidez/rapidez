<?php

namespace App\Models;

use App\Casts\QuoteItems;
use App\Models\Model;
use Illuminate\Database\Eloquent\Builder;

class Quote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quote';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'entity_id';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'items' => QuoteItems::class,
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('with-all-information', function (Builder $builder) {
            // TODO: add shipping information like "estimate-shipping-methods" does.
            $builder
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
                ->selectRaw('JSON_REMOVE(JSON_OBJECTAGG(IFNULL(quote_item.item_id, "null__"), JSON_OBJECT(
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
                )), "$.null__") AS items')
                ->join('quote_id_mask', 'quote_id_mask.quote_id', '=', 'quote.entity_id')
                ->leftJoin('quote_address', function ($join) {
                    $join->on('quote_address.quote_id', '=', 'quote_id_mask.quote_id')->where('address_type', 'shipping');
                })
                ->leftJoin('quote_item', function ($join) {
                    $join->on('quote_item.quote_id', '=', 'quote_id_mask.quote_id')->whereNull('parent_item_id');
                })
                ->leftJoin('quote_item_option', function ($join) {
                    $join->on('quote_item.item_id', '=', 'quote_item_option.item_id')->where('code', 'attributes');
                })
                ->leftJoin('catalog_product_flat_'.config('shop.store').' AS product', 'product.entity_id', '=', 'quote_item.product_id')
                ->groupBy('quote_id_mask.quote_id');
        });
    }
}
