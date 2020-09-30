<reactive-list
    component-id="products"
    data-field="name.keyword"
    list-class="flex flex-wrap mt-5 -mx-1 overflow-hidden"
    :pagination="true"
    :from="0"
    :size="32"
    :react="{and: reactiveFilters}"
    :default-query="categoryQuery"
    :sort-options="sortOptions"
    @query-change="onChange"
    u-r-l-params
>
    <div class="flex w-1/2 sm:w-1/3 md:w-1/4 px-1 my-1" slot="renderItem" slot-scope="{ item }">
        <a :href="'/'+item.url_key" class="block w-full bg-gray-100" :key="item.id">
            <img :src="'/image/200/catalog/product' + item.thumbnail" class="object-contain h-48 w-full mb-3" />
            <div class="px-2">
                <strong class="block hyphens">@{{ item.name }}</strong>
                <div class="">@{{ item.formatted_price }}</div>
            </div>
            <div v-if="item.variants">
                <ul class="flex">
                    <li v-for="variant in item.variants" class="h-16 w-16">
                        <img :src="'/image/64x64/catalog/product' + variant.image" class="object-contain h-16 w-full" />
                    </li>
                </ul>
            </div>
            <product-compare-checkbox
                :key="item.id"
                class-label="italic"
            />
        </a>
    </div>
</reactive-list>
