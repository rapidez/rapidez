<?php

use App\Category;
use App\Product;
use App\Rewrite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('{any?}', function ($url = null) {
    if ($rewrite = Rewrite::firstWhere('request_path', $url)) {
        if ($rewrite->entity_type == 'category') {
            if ($category = Category::find($rewrite->entity_id)) {
                return view('category', compact('category'));
            }
        }

        if ($rewrite->entity_type == 'product') {
            if ($product = Product::find($rewrite->entity_id)) {
                return view('product', compact('product'));
            }
        }
    }
    abort(404);
})->where('any', '.*');
