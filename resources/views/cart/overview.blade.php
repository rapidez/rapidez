@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <h1 class="font-bold text-4xl">Cart</h1>

    <cart v-cloak>
        <div v-if="hasItems" slot-scope="{ cart, hasItems, changeQty, remove }">
            <div class="flex items-center border-b pb-2 mb-2" v-for="(item, productId, index) in cart.items">
                <div class="w-1/12 pr-3">
                    <a :href="item.url" class="block">
                        <img
                            :alt="item.name"
                            :src="'/image/100x100/catalog/product' + item.image"
                            width="100"
                        />
                    </a>
                </div>
                <div class="w-8/12">
                    <a :href="item.url" class="font-bold">@{{ item.name }}</a>
                    <div v-for="(optionValue, option) in item.options">
                        @{{ option }}: @{{ optionValue }}
                    </div>
                </div>
                <div class="w-1/12 text-right font-mono pr-5">
                    @{{ item.price | price }}
                </div>
                <div class="w-1/12">
                    <div class="inline-flex">
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight font-mono text-right focus:outline-none focus:shadow-outline" type="number" min="1" v-model="item.qty" :dusk="'qty-'+index">
                        <button @click="changeQty(item)" class="btn btn-primary ml-1" title="Update" :dusk="'item-update-'+index">
                            <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6 18.7V21a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2H7.1A7 7 0 0 0 19 12a1 1 0 1 1 2 0 9 9 0 0 1-15 6.7zM18 5.3V3a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1h-5a1 1 0 0 1 0-2h2.9A7 7 0 0 0 5 12a1 1 0 1 1-2 0 9 9 0 0 1 15-6.7z"/></svg>
                        </button>
                    </div>
                </div>
                <div class="w-1/12 flex justify-end text-right font-mono">
                    @{{ item.total | price }}
                    <a href="#" @click.prevent="remove(item)" class="ml-2" title="Remove" :dusk="'item-delete-'+index">
                        <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v14h14V5H5zm8.41 7l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z"/></svg>
                    </a>
                </div>
            </div>

            <div class="flex justify-between items-start mt-5">
                @include('cart.coupon')
                <div class="flex flex-wrap justify-end w-64">
                    <div class="flex flex-wrap p-3 mb-5 bg-secondary rounded">
                        <div class="w-1/2">Subtotal</div>
                        <div class="w-1/2 font-mono text-right">@{{ cart.subtotal | price }}</div>
                        <div class="w-1/2">Tax</div>
                        <div class="w-1/2 font-mono text-right">@{{ cart.tax | price }}</div>
                        <div class="w-1/2" v-if="cart.discount_name">Discount: @{{ cart.discount_name }}</div>
                        <div class="w-1/2 font-mono text-right" v-if="cart.discount_amount != 0.00">@{{ cart.discount_amount | price }}</div>
                        <div class="w-1/2 font-bold">Total</div>
                        <div class="w-1/2 font-mono text-right font-bold">@{{ cart.total | price }}</div>
                    </div>
                    <a href="/checkout" class="btn btn-primary" dusk="checkout">Checkout</a>
                </div>
            </div>
        </div>
        <div v-else>
            You don't have anything in your cart.
        </div>
    </cart>
@endsection
