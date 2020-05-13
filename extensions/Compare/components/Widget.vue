<template>
    <div :class="classWrapper" v-if="Object.keys(products).length">
        <div :class="classProduct" v-for="product in products">
            <slot>
                {{ product.name }}
                <button :class="classRemoveButton" @click="compareRemove(product.id)">Remove</button>
            </slot>
        </div>
        <div class="text-center">
            <a href="/compare" :class="classCompareButton">Compare</a>
        </div>
    </div>
</template>

<script>
    import Methods from './mixins/Methods'

    export default {
        mixins: [Methods],

        props: {
            classWrapper: {
                default: 'fixed right-0 bottom-0 mr-16 p-3 bg-secondary rounded-t',
            },
            classProduct: {
                default: 'py-2',
            },
            classCompareButton: {
                default: 'inline-block btn btn-primary mt-3',
            },
            classRemoveButton: {
                default: 'float-right ml-5 text-gray-800 text-sm',
            },
        },

        computed: {
            products: function () {
                return this.$root.config.compare
            }
        }
    }
</script>
