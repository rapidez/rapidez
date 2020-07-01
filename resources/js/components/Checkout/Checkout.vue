<template>
    <renderless-checkout v-slot="{ checkout, cart, loading }">
        <div>
            <renderless-login v-if="checkout.step == 1" v-slot="{ email, password, go, emailChange, passwordChange, emailAvailable }">
                <div class="flex justify-center">
                    <form class="w-1/3 p-8 border rounded" v-on:submit.prevent="go()">
                        <h1 class="font-bold text-4xl text-center mb-5">Checkout</h1>
                        <input
                            class="form-input w-full"
                            id="email"
                            type="email"
                            placeholder="Email"
                            :value="email"
                            @input="emailChange"
                        >
                        <input
                            v-if="!emailAvailable"
                            class="form-input w-full mt-3"
                            id="password"
                            type="password"
                            placeholder="Password"
                            :value="password"
                            @input="passwordChange"
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

            <div v-if="checkout.step == 2" class="flex -mx-2">
                <div class="w-4/5 px-2">
                    Credentials
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
        </div>
    </renderless-checkout>
</template>
