export default {
    data: () => ({
        productId: null,
        compared: false,
    }),

    mounted() {
        this.productId = this.$vnode.key

        if (window.compare.includes(this.productId)) {
            this.compared = true
        }

        this.$watch('compared', (bool) => {
            bool ? this.compareAdd() : this.compareRemove()
        });
    },

    methods: {
        compareAdd() {
            window.compare.push(this.productId)

            axios.post('/compare', {
                product: this.productId
            }).catch(error => {
                alert('Something went wrong.')
            })
        },

        compareRemove() {
            window.compare = window.compare.filter(id => id !== this.productId)

            axios.delete('/compare/' + this.productId).catch(error => {
                alert('Something went wrong.')
            })
        }
    }
}
