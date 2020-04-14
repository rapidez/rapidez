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
                <div class="absolute w-screen top-auto -left-full bg-gray-500 z-10 bg-gray-70">
                    <ul class="container mx-auto flex flex-wrap" v-if="isOpen">
                        <li
                            class="flex w-1/2 sm:w-1/3 md:w-1/4 px-1 my-1"
                            v-for="suggestion in uniqueifyResults(suggestions || [])"
                            v-bind="getItemProps({ item: suggestion })"
                            v-on="getItemEvents({ item: suggestion })"
                            :key="suggestion._id">
                            <a :href="'/'+suggestion.source.url_key" class="block w-full bg-gray-100" key="suggestion._id">
                                <img :src="config.media_url+'/catalog/product/' + suggestion.source.thumbnail" class="object-contain h-48 w-full mb-3" />
                                <div class="px-2">
                                    <strong class="block hyphens">{{ suggestion.source.name }}</strong>
                                    <span class="brand">{{ suggestion.source.manufacturer }}</span>
                                    <i :inner-html.prop="suggestion.source.description | truncate(40)"></i>
                                    <div class="">&euro; {{ suggestion.source.price | price() }}</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </data-search>
    </reactive-base>
</template>

<script>
    export default {
        methods: {
            uniqueifyResults: (suggestions) => {
                var uniqueIds = [];
                return _.filter(suggestions, function (item) {
                    let present = !uniqueIds.includes(item.source.id)
                    uniqueIds.push(item.source.id);
                    return present;
                })
            },
            getCustomHighlight: (props) => ({
                highlight: {
                    pre_tags: ['<mark>'],
                    post_tags: ['</mark>'],
                    fields: {
                        name: {},
                        description: {},
                    },
                    number_of_fragments: 0,
                }
            }),
        }
    };
</script>
