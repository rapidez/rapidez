import Methods from './Methods'

export default {
    mixins: [Methods],

    data: () => ({
        productId: null
    }),

    mounted() {
        this.productId = this.$vnode.key
    },

    computed: {
        checked: function () {
            return this.$root.config.compare[this.productId]
        }
    }
}
