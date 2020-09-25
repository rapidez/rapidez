<template>
    <reactive-base
        :app="'products_' + config.store"
        :url="config.es_url">

        <data-search
            componentId="SearchSensor"
            :dataField="config.searchable"
            highlight
            :customHighlight="getCustomHighlight"
            :debounce="100"
            :size="10">
            <div
                class="suggestions"
                slot="render"
                slot-scope="{
                    error,
                    loading,
                    downshiftProps: { isOpen, highlightedIndex, getItemProps, getItemEvents },
                    data: suggestions,
                }">
                    <ul class="absolute left-0 right-auto z-10 bg-white shadow-xl rounded-b-lg lg:rounded-t-lg w-screen sm:w-full lg:w-960px xl:ml-0 left-1/2 transform -translate-x-1/2 xl:rounded-t-lg mt-px flex flex-wrap" v-if="isOpen">
                        <li
                            class="flex w-1/2 sm:w-1/2 md:w-1/3 px-4 my-4"
                            v-for="suggestion in suggestions"
                            v-bind="getItemProps({ item: suggestion })"
                            v-on="getItemEvents({ item: suggestion })"
                            :key="suggestion._id">
                            <a :href="'/'+suggestion.source.url_key" class="flex flex-wrap w-full h-full" key="suggestion._id">
                                <img :src="config.media_url+'/catalog/product/' + suggestion.source.thumbnail" class="object-contain lg:w-3/12 self-center" />
                                <div class="px-2 flex flex-wrap flex-grow lg:w-1/2">
                                    <strong class="block hyphens w-full">{{ suggestion.source.name }}</strong>
                                    <span class="brand w-full">{{ suggestion.source.manufacturer }}</span>
                                    <div class="self-end">&euro; {{ suggestion.source.price | price }}</div>
                                </div>
                            </a>
                        </li>
                    </ul>
            </div>
        </data-search>
    </reactive-base>
</template>

<script>
    export default {
        methods: {
            getCustomHighlight: (props) => ({
                highlight: {
                    pre_tags: ['<mark>'],
                    post_tags: ['</mark>'],
                    fields: {
                        name: {}
                    },
                    number_of_fragments: 0,
                }
            }),
        }
    };
</script>
