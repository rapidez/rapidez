<template>
    <div>
        <reactive-base
            :app="'products_' + store"
            url="http://localhost:9200"
        >
            <div class="flex">
                <div class="w-1/5">
                    <multi-list
                        componentId="Maingroup"
                        dataField="main_group.keyword"
                        class="filter"
                        title="Main group"
                        selectAllLabel="All groups"
                        :react="{and: ['Maingroup', 'Colors']}"
                        URLParams
                    />

                    <multi-list
                        componentId="Colors"
                        dataField="color.keyword"
                        class="filter"
                        title="Color"
                        selectAllLabel="All colors"
                        :react="{and: ['Maingroup', 'Colors']}"
                        URLParams
                    />
                </div>
                <div class="w-4/5">
                    <reactive-list
                        componentId="SearchResult"
                        dataField="name.keyword"
                        listClass="flex flex-wrap mt-5 -mx-1 overflow-hidden"
                        :pagination="true"
                        :from="0"
                        :size="32"
                        :react="{and: ['Maingroup', 'Colors']}"
                    >
                        <div class="flex w-1/2 sm:w-1/3 md:w-1/4 px-1 my-1" slot="renderItem" slot-scope="{ item }">
                            <a :href="'/'+item.url_key" class="block w-full bg-gray-100" key="item._id">
                                <img :src="item.image" class="object-contain h-48 w-full mb-3" />
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
        props: ['store'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
