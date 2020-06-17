<template>
    <div>
        <div v-for="(superAttribute, superAttributeId) in config.product.super_attributes">
            <label :for="'super_attribute_'+superAttributeId">{{ superAttribute.label }}</label>
            <div class="inline-block relative w-64 mb-3">
                <select
                    :id="'super_attribute_'+superAttributeId"
                    :name="superAttributeId"
                    v-model="options[superAttributeId]"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                >
                    <option value="">Select {{ superAttribute.label }}</option>
                    <option
                        v-for="(label, value) in config.product[superAttribute.code]"
                        v-text="label"
                        :value="value"
                    />
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
        <button
            :class="btnClass"
            :disabled="this.$root.loading"
            @click="add()"
        >
            Add to cart
        </button>
        <div
            v-if="error"
            v-text="error"
            class="text-red-600"
        />
    </div>
</template>

<script>
    import GetCart from './../Cart/mixins/GetCart'

    // TODO: Also make this a renderless component?
    export default {
        mixins: [GetCart],
        props: ['btnClass'],
        data: () => ({
            options: {},
            error: null,
        }),
        methods: {
            async add() {
                await this.refreshCart()

                magento.post('guest-carts/' + this.cart.id + '/items', {
                    cartItem: {
                        sku: config.product.sku,
                        quote_id: localStorage.getItem('mask'),
                        qty: 1,
                        product_option: this.productOptions
                    }
                }).then((response) => this.refreshCart()).catch((error) => {
                    this.error = error.response.data.message
                })
            },
        },
        computed: {
            productOptions: function () {
                let options = []
                Object.entries(this.options).forEach(([key, val]) => {
                    options.push({
                        option_id: key,
                        option_value: val,
                    });
                });
                return {
                    extension_attributes: {
                        configurable_item_options: options
                    }
                }
            }
        }
    }
</script>
