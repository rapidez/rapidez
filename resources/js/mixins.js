Vue.mixin({
    methods: {
        async asyncForEach(array, callback) {
            for (let index = 0; index < array.length; index++) {
                await callback(array[index], index, array);
            }
        },

        async magentoCart(method, endpoint, data) {
            if (this.$root.user) {
                return await magentoUser[method]('carts/mine/' + endpoint, data)
            } else {
                return await magento[method]('guest-carts/' + localStorage.mask + '/' + endpoint, data)
            }
        }
    }
})


