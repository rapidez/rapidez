<template>
    <div>
        <reactive-base
            :app="'products_' + store"
            url="http://localhost:9200"
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
                        URLParams
                    >
                        <div class="flex w-1/2 sm:w-1/3 md:w-1/4 px-1 my-1" slot="renderItem" slot-scope="{ item }">
                            <a :href="'/'+item.url_key" class="block w-full bg-gray-100" key="item._id">
                                <img :src="mediaUrl+'/catalog/product/' + item.small_image" class="object-contain h-48 w-full mb-3" />
                                <div class="px-2">
                                    <strong class="block hyphens">{{ item.name }}</strong>
                                    <div class="">&euro;{{ item.price }}</div>
                                </div>
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
        props: ['store', 'mediaUrl'],

        data: () => ({ filters: [] }),

        mounted() {
            var me = this;
            // TODO: Cache this in session storage
            // so it only fires once per visit.
            axios.get('/api/filters')
                 .then(function (response) {
                    me.filters = response.data
                 })
                 .catch(function (error) {
                    alert('Something went wrong')
                 })
        },

        computed: {
            reactiveFilters: function () {
                var reactiveFilters = [];
                Object.keys(this.filters).forEach(filterId => {
                    reactiveFilters.push('filter_' + this.filters[filterId]['code'])
                })
                return reactiveFilters;
            }
        }
    }
</script>
