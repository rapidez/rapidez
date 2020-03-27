<template>
    <div class="flex mb-5 bg-gray-400">
        <div class="w-1/3">
            Logo
        </div>
        <div class="w-1/3">
            <autocomplete
                :store="store"
                :category="category"
                :media-url="mediaUrl">
            </autocomplete>
        </div>
        <div class="w-1/3">
            Meuk
        </div>
    </div>
</template>

<script>
    export default {
        props: ['store', 'category', 'mediaUrl']
    };
</script>
