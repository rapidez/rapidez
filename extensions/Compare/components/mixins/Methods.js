export default {
    methods: {
        compareToggle(productId) {
            if (productId in this.$root.shop.compare) {
                this.compareRemove(productId)
            } else {
                this.compareAdd(productId)
            }
        },

        compareAdd(productId) {
            axios.post('/compare', {
                product: productId
            }).then(response => {
                this.$root.shop.compare = response.data;
            }).catch(error => {
                alert('Something went wrong.')
            })
        },

        compareRemove(productId) {
            axios.delete('/compare/' + productId).then(response => {
                this.$root.shop.compare = response.data;
            }).catch(error => {
                alert('Something went wrong.')
            })
        }
    }
}
