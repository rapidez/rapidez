<reactive-base
    :app="'products_' + config.store"
    :url="config.es_url"
    v-cloak
>
    <data-search
        component-id="autocomplete"
        :inner-class="{ input: 'rounded' }"
        :data-field="config.searchable"
        :show-icon="false"
        fuzziness="AUTO"
        :debounce="100"
        :size="9"
    >
        <div
            slot="render"
            slot-scope="{ downshiftProps: { isOpen }, data: suggestions }"
        >
            <ul class="absolute left-0 right-auto z-20 bg-white border shadow-xl rounded-b-lg lg:rounded-t-lg w-screen sm:w-full lg:w-960px xl:ml-0 left-1/2 transform -translate-x-1/2 xl:rounded-t-lg mt-px flex flex-wrap" v-if="isOpen && suggestions.length">
                <li
                    class="flex w-1/2 sm:w-1/2 md:w-1/3 px-4 my-4"
                    v-for="suggestion in suggestions"
                    :key="suggestion._id"
                >
                    <a :href="suggestion.source.url" class="flex flex-wrap w-full h-full" key="suggestion._id">
                        <img :src="'/image/100x100/catalog/product' + suggestion.source.thumbnail" class="object-contain lg:w-3/12 self-center" />
                        <div class="px-2 flex flex-wrap flex-grow lg:w-1/2">
                            <strong class="block hyphens w-full">@{{ suggestion.source.name }}</strong>
                            <div class="self-end">@{{ suggestion.source.price | price }}</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </data-search>
</reactive-base>
