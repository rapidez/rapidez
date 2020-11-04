<script>
    import GetCart from './../Cart/mixins/GetCart'

    export default {
        mixins: [GetCart],

        data: () => ({
            options: {},
            error: null,
        }),

        render() {
            return this.$scopedSlots.default({
                options: this.options,
                error: this.error,
                add: this.add,
            })
        },

        methods: {
            async add() {
                await this.getMask()

                this.magentoCart('post', 'items', {
                    cartItem: {
                        sku: config.product.sku,
                        quote_id: localStorage.getItem('mask'),
                        qty: 1,
                        product_option: this.productOptions
                    }
                }).then((response) => {
                    this.refreshCart()
                    this.error = null
                }).catch((error) => {
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
