<button type="button" class="md:hidden btn btn-primary w-full mb-3">@lang('Filters')</button>

<div class="hidden md:block" v-for="filter in filters" :key="filter.code">
    <dynamic-range-slider
        v-if="filter.input == 'price'"
        :component-id="'filter_'+filter.code"
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
        :component-id="'filter_'+filter.code"
        :data-field="filter.code + '.keyword'"
        class="filter"
        :title="filter.name+(filter.input == 'multiselect' ? '(and)' : '(or)')"
        :select-all-label="'All '+ filter.name"
        :react="{and: reactiveFilters}"
        :default-query="categoryQuery"
        :query-format="filter.input == 'multiselect' ? 'and' : 'or'"
        u-r-l-params
    ></multi-list>
</div>
