<?php

use App\Attribute;
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

Route::get('filters', function () {
    return $attributes = array_filter(Attribute::all()->toArray(), function($attribute) {
        return $attribute['filter'];
    });
    // some weird caching shizzle how to fix this? @ROY :D ?
    // return Attribute::getCachedWhere(function ($attribute) {
    //     return $attribute['filter'];
    // });
});
