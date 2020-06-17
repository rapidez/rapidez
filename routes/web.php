<?php

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Rewrite;

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

Route::view('/cart', 'cart');
Route::view('/checkout', 'checkout');

Route::get('{any?}', function ($url = null) {
    if ($rewrite = Rewrite::firstWhere('request_path', $url)) {
        if ($rewrite->entity_type == 'category') {
            if ($category = Category::find($rewrite->entity_id)) {
                config(['frontend.category' => $category->only('entity_id')]);
                return view('category', compact('category'));
            }
        }

        if ($rewrite->entity_type == 'product') {
            if ($product = Product::selectForProductPage()->find($rewrite->entity_id)) {
                $attributes = ['sku', 'super_attributes'];
                foreach ($product->super_attributes ?: [] as $superAttribute) {
                    $attributes[] = $superAttribute->code;
                }
                config(['frontend.product' => $product->only($attributes)]);
                return view('product', compact('product'));
            }
        }
    }

    if ($page = Page::firstWhere('identifier', $url ?: 'home')) {
        return view('page', compact('page'));
    }

    abort(404);
})->where('any', '.*');
