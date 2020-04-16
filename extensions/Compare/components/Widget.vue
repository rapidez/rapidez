<template>
    <div :class="classWrapper">
        <div :class="classProduct" v-for="product in products">
            <slot>
                {{ product.name }}
                <button :class="classButton" @click="compareRemove(product.id)">Remove</button>
            </slot>
        </div>
    </div>
</template>

<script>
    import Methods from './mixins/Methods'

    export default {
        mixins: [Methods],

        props: {
            classWrapper: {
                default: 'fixed right-0 bottom-0 mr-16 p-3 bg-gray-500 rounded-t',
            },
            classProduct: {
                default: '',
            },
            classButton: {
                default: '',
            }
        },

        computed: {
            products: function () {
                return this.$root.shop.compare
            }
        }
    }
</script>
