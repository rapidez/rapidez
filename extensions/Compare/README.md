# Compare

The compared products are available at `this.$root.config.compare` on the category and compare page which is reactive.

## Checkbox

There is a `Checkbox.vue` component which can be used. Just register it in the `app.js`:
```
Vue.component('product-compare-checkbox', require('Extensions/Compare/components/Checkbox.vue').default);
```
This component can be customized with `classLabel` and `classCheckbox` props. If it does not fit your needs you can create your own Vue component and use the mixin: `CheckboxLogic.js` for the functionality as done within the component. The product ID should be passed as component key:
```
<product-compare-checkbox :key="item.id" />
```

## Widget

There is a `Widget.vue` component which can be used. Just register it in the `app.js`:
```
Vue.component('product-compare-widget', require('Extensions/Compare/components/Widget.vue').default);
```
This component can be customized with multiple class props. It's also possible to overwrite the product part of it with the slot. If it does not fit your needs you can create your own Vue component and use the mixin: `Methods.js` for the functionality as done within the component. Most likely the component is displayed fixed so render it at the end of the html with for example the `page_end` stack on the `category.blade.php`:
```
@push('page_end')
    <product-compare-widget
        class-wrapper="fixed right-0 bottom-0 mr-16 p-3 bg-blue-500 rounded-t"
    />
@endpush
```
The props should be in kebab-case in Blade.

## Overview

Just like the others there is a `Overview.vue` component. And because this is a whole page there is also a Blade view. To overwrite that view you've to publish it with `php artisan vendor:publish --provider="Extensions\Compare\CompareExtensionServiceProvider"`.
