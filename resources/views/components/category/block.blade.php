@props(['title', 'description', 'image', 'link', 'button'])

<a
    class="group relative h-72 w-full overflow-hidden rounded-xl sm:first:row-span-2 sm:first:h-full"
    href="{{ $link . Rapidez\Core\Models\Config::getCachedByPath('catalog/seo/category_url_suffix', '.html') }}"
>
    <img
        class="h-full w-full object-cover"
        src="{{ $image }}"
        alt=""
    />
    <div
        class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50 transition group-hover:opacity-40">
    </div>
    <div class="absolute bottom-0 left-0 flex flex-col gap-1 p-5 text-white">
        <div>
            <h2 class="text-lg font-semibold">@lang($title)</h2>
            <p class="text-md text-gray-200">@lang($description)</p>
        </div>
        <span>{{ $button }}</span>
    </div>
</a>
