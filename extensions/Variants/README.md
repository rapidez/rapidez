# Variants

A `variants` attribute will be added to products. You can for example loop through it and display them in the product listing (make sure to reindex):

```
<div v-if="item.variants">
    <ul class="flex">
        <li v-for="variant in item.variants" class="h-16 w-16">
            <img :src="config.media_url+'/catalog/product' + variant.image" class="object-contain h-16 w-full" />
        </li>
    </ul>
</div>
```
