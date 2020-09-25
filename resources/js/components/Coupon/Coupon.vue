<template>
    <div class="bg-white sm:rounded-lg border">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Apply coupon code
            </h3>
            <renderless-coupon v-slot="{ cart, removeCoupon, couponCode, inputEvents, applyCoupon, submitError }">
                <div>
                    <form class="mt-5 sm:flex sm:items-center" @submit.prevent="applyCoupon">
                        <div class="max-w-xs w-full">
                            <div class="relative rounded-md">
                                <input
                                    id="couponCode"
                                    class="form-input block w-full sm:text-sm sm:leading-5"
                                    placeholder="Apply coupon code"
                                    v-on="inputEvents"
                                    :value="couponCode"
                                    >
                            </div>
                        </div>
                        <span class="mt-3 inline-flex rounded-md sm:mt-0 sm:ml-3 sm:w-auto">
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </span>
                    </form>
                    <p class="text-red-500 text-xs italic w-3/4 mt-3">{{ submitError }}</p>
                    <div class="relative rounded-md" v-if="cart.discount_name">
                        <div class="w-100">
                            <button class="inline-block" @click="removeCoupon">
                                <svg class="h-4 w-4 inline-block text-black-400" fill="none" viewBox="0 0 12 12">
                                    <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            Discount: {{ cart.discount_name }}
                        </div>
                    </div>
                </div>
            </renderless-coupon>
        </div>
    </div>
</template>
