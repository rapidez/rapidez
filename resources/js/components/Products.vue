<template>
    <div :style="baseStyles">
        <reactive-base
            :app="'products_' + config.store"
            :url="config.es_url"
            v-if="loaded"
        >
            <selected-filters />
            <div class="flex">
                <div class="w-1/5">
                    <div v-for="filter in filters" :key="filter.code">
                        <dynamic-range-slider
                            v-if="filter.input == 'price'"
                            :componentId="'filter_'+filter.code"
                            :dataField="filter.code"
                            class="filter"
                            :title="filter.name"
                            URLParams
                            :showFilter="false"
                        />
                        <multi-list
                            v-else
                            :componentId="'filter_'+filter.code"
                            :dataField="filter.code + '.keyword'"
                            class="filter"
                            :title="filter.name"
                            :selectAllLabel="'All '+ filter.name"
                            :react="{and: reactiveFilters}"
                            URLParams
                        />
                    </div>
                </div>
                <div class="w-4/5">
                    <reactive-list
                        componentId="SearchResult"
                        dataField="name.keyword"
                        listClass="flex flex-wrap mt-5 -mx-1 overflow-hidden"
                        :pagination="true"
                        :from="0"
                        :size="32"
                        :react="{and: reactiveFilters}"
                        :defaultQuery="categoryQuery"
                        :sortOptions="sortOptions"
                        @queryChange="onChange"
                        URLParams
                    >
                        <div class="flex w-1/2 sm:w-1/3 md:w-1/4 px-1 my-1" slot="renderItem" slot-scope="{ item }">
                            <a :href="'/'+item.url_key" class="block w-full bg-gray-100" :key="item.id">
                                <img :src="config.media_url+'/catalog/product' + item.thumbnail" class="object-contain h-48 w-full mb-3" />
                                <div class="px-2">
                                    <strong class="block hyphens">{{ item.name }}</strong>
                                    <div class="">&euro;{{ item.price }}</div>
                                </div>
                                <div v-if="item.variants">
                                    <ul class="flex">
                                        <li v-for="variant in item.variants" class="h-16 w-16">
                                            <img :src="config.media_url+'/catalog/product' + variant.image" class="object-contain h-16 w-full" />
                                        </li>
                                    </ul>
                                </div>
                                <product-compare-checkbox
                                    :key="item.id"
                                    classLabel="italic"
                                />
                            </a>
                        </div>
                    </reactive-list>
                </div>
            </div>
        </reactive-base>
    </div>
</template>

<script>
    export default {
        data: () => ({
            loaded: false,
            attributes: [],
            baseStyles: {},
        }),

        mounted() {
            if (sessionStorage.getItem('height')) {
                this.baseStyles = {
                    minHeight: sessionStorage.getItem('height') + 'px'
                }
            }

            if (sessionStorage.getItem('attributes')) {
                this.attributes = JSON.parse(sessionStorage.getItem('attributes'))
                this.loaded = true
                return;
            }

            axios.get('/api/attributes')
                 .then((response) => {
                    this.attributes = response.data
                    sessionStorage.setItem('attributes', JSON.stringify(this.attributes))
                    this.loaded = true
                 })
                 .catch((error) => {
                    alert('Something went wrong')
                 })
        },

        methods: {
            categoryQuery() {
                return {
                    "query": {
                        "terms": {
                            "category_ids": [ this.$root.shop.config.category ]
                        }
                    }
                }
            },
            onChange() {
                sessionStorage.setItem('height', this.$el.clientHeight)
            }
        },

        computed: {
            filters: function () {
                return _.filter(this.attributes, function (attribute) {
                    return attribute.filter;
                })
            },
            sortings: function () {
                return _.filter(this.attributes, function (attribute) {
                    return attribute.sorting;
                })
            },
            reactiveFilters: function () {
                return _.map(this.filters, function (filter) {
                    return 'filter_' + filter.code;
                })
            },
            sortOptions: function () {
                return _.flatMap(this.sortings, function (sorting) {
                    return _.map(['asc', 'desc'], function (direction) {
                        return {
                            label: sorting.name + ' ' + direction,
                            dataField: sorting.code + (sorting.code != 'price' ? '.keyword' : ''),
                            sortBy: direction
                        }
                    })
                })
            }
        }
    }
</script>
