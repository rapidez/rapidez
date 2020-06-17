<template>
    <renderless-cart>
        <div v-if="cart" slot-scope="{ cart, changeQty }">
            <div class="flex items-center border-b pb-2 mb-2" v-for="item in cart.items">
                <div class="font-bold w-10/12">{{ item.name }}</div>
                <div class="w-1/12">
                    <div class="inline-flex">
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight font-mono text-right focus:outline-none focus:shadow-outline" type="number" v-model="item.qty">
                        <button @click="changeQty(item)" class="btn btn-primary ml-1">
                            <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6 18.7V21a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2H7.1A7 7 0 0 0 19 12a1 1 0 1 1 2 0 9 9 0 0 1-15 6.7zM18 5.3V3a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1h-5a1 1 0 0 1 0-2h2.9A7 7 0 0 0 5 12a1 1 0 1 1-2 0 9 9 0 0 1 15-6.7z"/></svg>
                        </button>
                    </div>
                </div>
                <div class="w-1/12 text-right font-mono">
                    {{ item.price | price }}
                </div>
            </div>
        </div>
        <div v-else>
            You don't have anything in your cart.
        </div>
    </renderless-cart>
</template>
