export default {
    methods: {
        async refreshCart() {
            await this.getMask()

            if (localStorage.getItem('mask')) {
                try {
                    let response = await magento.get('guest-carts/' + localStorage.getItem('mask'))
                    if (response !== undefined && response.data) {
                        localStorage.setItem('cart', JSON.stringify(response.data))
                        this.$root.config.cart = response.data
                    }
                } catch (error) {
                    if (error.response.status == 404) {
                        localStorage.removeItem('mask')
                    }
                    alert('Something went wrong, please try again')
                }
            }
        },

        async getMask() {
            if (!localStorage.getItem('mask')) {
                let response = await magento.post('guest-carts').catch((error) => alert('Something went wrong, please try again'))
                if (response !== undefined && response.data) {
                    localStorage.setItem('mask', response.data)
                }
            }
        },
    },

    computed: {
        cart: function () {
            if (this.$root.config.cart === null && localStorage.cart) {
                this.$root.config.cart = JSON.parse(localStorage.cart)
            }
            return this.$root.config.cart
        }
    }
}
