<script>
    import GetCart from './../Cart/mixins/GetCart'

    export default {
        mixins: [GetCart],

        render() {
            return this.$scopedSlots.default({
                cart: this.cart,
                checkout: this.checkout,
                loading: this.$root.loading,
                inputChange: this.inputChange,
                save: this.save,
            })
        },

        methods: {
            inputChange(type, e) {
                this.$root.checkout[type][e.target.id] = e.target.value
            },

            async save(savedItems, goToStep) {
                let validated = true
                await this.asyncForEach(savedItems, async item => {
                    switch(item) {
                        case 'credentials':
                            if (!await this.saveCredentials()) {
                                validated = false
                            }
                            break
                        case 'payment_method':
                            if (!await this.savePaymentMethod()) {
                                validated = false
                            }
                            break
                        default:
                            alert('Unknown item to save')
                    }
                })

                if (validated) {
                    this.$root.checkout.step = goToStep
                }
            },

            async saveCredentials() {
                if (!this.validateCredentials()) {
                    return false
                }

                try {
                    let response = await magento.post('guest-carts/' + localStorage.mask + '/shipping-information', {
                        addressInformation: {
                            shipping_address: this.shippingAddress,
                            // TODO: Make selectable and later implement carriers like Paazl.
                            shipping_carrier_code: 'freeshipping',
                            shipping_method_code: 'freeshipping'
                        }
                    })
                    this.$root.checkout.payment_methods = response.data.payment_methods
                    return true
                } catch (error) {
                    alert(error.response.data.message)
                    return false
                }
            },

            validateCredentials() {
                let validated = true
                Object.entries(this.$root.checkout.shipping_address).forEach(([key, val]) => {
                    if (!val) {
                        alert(key + ' cannot be empty')
                        validated = false
                    }
                });

                return validated
            },

            async savePaymentMethod() {
                if (!this.$root.checkout.payment_method) {
                    // return false
                }

                try {
                    let response = await magento.post('guest-carts/' + localStorage.mask + '/payment-information', {
                        billingAddress: this.shippingAddress,
                        email: this.$root.guestEmail,
                        paymentMethod: {
                            method: this.$root.checkout.payment_method
                        }
                    })
                    // response.data = orderId
                    localStorage.removeItem('mask')
                    localStorage.removeItem('cart')
                    this.$root.cart = null
                    return true
                } catch (error) {
                    alert(error.response.data.message)
                    return false
                }
            }
        },

        computed: {
            checkout: function () {
                return this.$root.checkout
            },

            shippingAddress: function () {
                return {
                    firstname: this.checkout.shipping_address.firstname,
                    lastname: this.checkout.shipping_address.lastname,
                    postcode: this.checkout.shipping_address.zipcode,
                    street: [
                        this.checkout.shipping_address.street,
                        this.checkout.shipping_address.housenumber
                    ],
                    city: this.checkout.shipping_address.city,
                    country_id: 'NL',
                    telephone: this.checkout.shipping_address.telephone,
                }
            }
        }
    }
</script>
