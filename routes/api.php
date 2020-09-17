<?php

use App\Models\Attribute;
use App\Models\OptionSwatch;
use Illuminate\Http\Request;
use App\Models\Quote;

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

Route::get('swatches', function () {
    return OptionSwatch::getCachedSwatchValues();
});

Route::get('cart/{quoteIdMaskOrCustomerToken}', function ($quoteIdMaskOrCustomerToken) {
    return Quote::where(function ($query) use ($quoteIdMaskOrCustomerToken) {
        $query->where('masked_id', $quoteIdMaskOrCustomerToken)
              ->orWhere('token', $quoteIdMaskOrCustomerToken);
    })->firstOrFail();
});
