<x-slideover>
    <x-slot name="button">
        <button type="button" class="md:hidden btn btn-primary w-full mb-3" @click="toggle">@lang('Filters')</button>
    </x-slot>

    <reactive-component component-id="category">
        <div slot-scope="{ setQuery }">
            <category-filter :set-query="setQuery"></category-filter>
        </div>
    </reactive-component>

    <div v-for="filter in filters" :key="filter.code">
        <dynamic-range-slider
            v-if="filter.input == 'price'"
            :component-id="filter.code"
            :data-field="filter.code"
            :title="filter.name"
            :show-filter="false"
            class="filter"
            u-r-l-params
        ></dynamic-range-slider>
        <swatch-filter
            v-else-if="filter.text_swatch || filter.visual_swatch"
            :attribute-data="filter"
            :data-type="!! filter.text_swatch ? 'text' : 'visual'"
            :swatch-classes="!! filter.text_swatch ? '' : 'focus:shadow-outlin rounded-full cursor-pointer m-1 border-solid border-2 border-black h-6 w-6'"
        ></swatch-filter>
        <multi-list
            v-else
            :component-id="filter.code"
            :data-field="filter.code + '.keyword'"
            :inner-class="{
                title: 'capitalize font-semibold',
                count: 'text-gray-400',
                list: 'max-h-none-important',
                label: 'text-gray-600'
            }"
            :title="filter.name+(filter.input == 'multiselect' ? '' : '(or)')"
            :react="{and: reactiveFilters}"
            :query-format="filter.input == 'multiselect' ? 'and' : 'or'"
            :show-search="false"
            u-r-l-params
        ></multi-list>
    </div>
</x-slideover>
