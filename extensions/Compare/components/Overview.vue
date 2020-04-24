<template>
    <div class="flex -mx-2">
        <div class="px-2" v-for="product in products">
            <div class="bg-gray-200 p-3 rounded">
                <strong>{{ product.name }}</strong>
                <button @click="compareRemove(product.id)">Remove</button>
            </div>
        </div>
    </div>
</template>

<script>
    import Methods from './mixins/Methods'

    export default {
        mixins: [Methods],

        computed: {
            products: function () {
                return this.$root.config.compare
            }
        }
    }
</script>
