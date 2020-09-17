<template>
    <renderless-checkout v-slot="{ checkout, cart, loading, inputChange, save }">
        <div>
            <renderless-login v-if="checkout.step == 1" v-slot="{ email, password, go, loginInputChange, emailAvailable }">
                <div class="flex justify-center">
                    <form class="w-1/3 p-8 border rounded" v-on:submit.prevent="go()">
                        <h1 class="font-bold text-4xl text-center mb-5">Checkout</h1>
                        <input
                            class="form-input w-full"
                            id="email"
                            type="email"
                            placeholder="Email"
                            :value="email"
                            @input="loginInputChange"
                        >
                        <input
                            v-if="!emailAvailable"
                            class="form-input w-full mt-3"
                            id="password"
                            type="password"
                            placeholder="Password"
                            :value="password"
                            @input="loginInputChange"
                        >
                        <button
                            type="submit"
                            class="btn btn-primary w-full mt-5"
                            :disabled="loading"
                        >
                            Continue
                        </button>
                    </form>
                </div>
            </renderless-login>

            <div v-if="[2, 3].includes(checkout.step)" class="flex -mx-2">
                <div class="w-4/5 px-2">
                    <div v-if="checkout.step == 2">
                        <h1 class="font-bold text-4xl mb-5">Credentials</h1>

                        <form class="w-2/3" v-on:submit.prevent="save(['credentials'], 3)">
                            <div class="grid grid-cols-12 col-gap-4 mb-3">
                                <label class="col-span-12 text-gray-700 text-sm" for="firstname">Name</label>
                                <div class="col-span-6">
                                    <input
                                        type="text"
                                        class="form-input w-full"
                                        id="firstname"
                                        placeholder="Firstname"
                                        :value="checkout.shipping_address.firstname"
                                        @input="inputChange('shipping_address', $event)"
                                    >
                                </div>
                                <div class="col-span-4">
                                    <input
                                        type="text"
                                        class="form-input w-full"
                                        id="lastname"
                                        placeholder="Lastname"
                                        :value="checkout.shipping_address.lastname"
                                        @input="inputChange('shipping_address', $event)"
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-12 col-gap-4 mb-3">
                                <div class="col-span-3">
                                    <label class="text-gray-700 text-sm" for="zipcode">Postcode</label>
                                    <input
                                        type="text"
                                        class="form-input w-full"
                                        id="zipcode"
                                        placeholder="Zipcode"
                                        :value="checkout.shipping_address.zipcode"
                                        @input="inputChange('shipping_address', $event)"
                                    >
                                </div>
                                <div class="col-span-3">
                                    <label class="text-gray-700 text-sm" for="housenumber">Housenumber</label>
                                    <input
                                        type="text"
                                        class="form-input w-full"
                                        id="housenumber"
                                        placeholder="Nr."
                                        :value="checkout.shipping_address.housenumber"
                                        @input="inputChange('shipping_address', $event)"
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-12 col-gap-4 mb-3">
                                <div class="col-span-6">
                                    <label class="text-gray-700 text-sm" for="street">Street</label>
                                    <input
                                        type="text"
                                        class="form-input w-full"
                                        id="street"
                                        placeholder="Street"
                                        :value="checkout.shipping_address.street"
                                        @input="inputChange('shipping_address', $event)"
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-12 col-gap-4 mb-3">
                                <div class="col-span-6">
                                    <label class="text-gray-700 text-sm" for="city">City</label>
                                    <input
                                        type="text"
                                        class="form-input w-full"
                                        id="city"
                                        placeholder="City"
                                        :value="checkout.shipping_address.city"
                                        @input="inputChange('shipping_address', $event)"
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-12 col-gap-4 mb-3">
                                <div class="col-span-6">
                                    <label class="text-gray-700 text-sm" for="telephone">Telephone</label>
                                    <input
                                        type="text"
                                        class="form-input w-full"
                                        id="telephone"
                                        placeholder="Telephone"
                                        :value="checkout.shipping_address.telephone"
                                        @input="inputChange('shipping_address', $event)"
                                    >
                                </div>
                            </div>

                            <h1 class="font-bold text-4xl mt-5 mb-3">Shipping method</h1>

                            <div class="my-2" v-for="method in checkout.shipping_methods">
                                <input
                                    type="radio"
                                    name="shipping_method"
                                    :value="method.carrier_code+'_'+method.method_code"
                                    :id="method.carrier_code+'_'+method.method_code"
                                    v-model="checkout.shipping_method"
                                >
                                <label :for="method.carrier_code+'_'+method.method_code">{{ method.method_title }}</label>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary mt-3"
                                :disabled="loading"
                            >
                                Continue
                            </button>
                        </form>
                    </div>

                    <div v-if="checkout.step == 3">
                        <h1 class="font-bold text-4xl mb-5">Payment method</h1>
                        <form class="w-2/3" v-on:submit.prevent="save(['payment_method'], 4)">
                            <div class="my-2" v-for="method in checkout.payment_methods">
                                <input
                                    type="radio"
                                    name="payment_method"
                                    :value="method.code"
                                    :id="method.code"
                                    v-model="checkout.payment_method"
                                >
                                <label :for="method.code">{{ method.title }}</label>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="loading"
                            >
                                Continue
                            </button>
                        </form>
                    </div>
                </div>
                <div class="w-1/5 px-2">
                    <div v-if="cart" class="p-3 border rounded">
                        <table class="mb-3">
                            <tr class="py-3" v-for="item in cart.items">
                                <td>{{ item.name }}</td>
                                <td class="text-right font-mono text-xs px-4">{{ item.qty }}</td>
                                <td class="text-right font-mono text-xs">{{ item.price | price }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div v-if="checkout.step == 4">
                <h1 class="font-bold text-4xl mb-5">Order placed succesfully</h1>
                <p>Partytime!</p>
                <p class="animate-spin inline-block text-6xl">🥳</p>
            </div>
        </div>
    </renderless-checkout>
</template>
