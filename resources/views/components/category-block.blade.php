@props(['title', 'description', 'image', 'link', 'button'])

<div {{ $attributes->merge(['class' => 'w-full h-64 overflow-hidden bg-cover bg-center']) }} style="background-image: url('{{ $image }}')">
    <div class="bg-gray-900 bg-opacity-25 flex items-end h-full">
        <div class="max-w-md p-6 inline-block -mb-4">
            <h2 class="text-3xl text-white font-semibold">{{ $title }}</h2>
            <p class="mt-2 text-white text-sm">{{ $description }}</p>
            <div class="-ml-1">
                <div class="bg-white p-1 -mb-3 -ml-6 inline-block mt-5">
                    <a href="{{ $link.Rapidez\Core\Models\Config::getCachedByPath('catalog/seo/category_url_suffix', '.html') }}" class="group inline-flex wrap bg-pink text-green-800 text-sm font-medium overflow-hidden cursor-pointer bg-green-400 hover:bg-gray-200 transition duration-100 ease-in-out">
                        <span class="px-6 py-3 border-r border-solid border-green-300">{{ $button }}</span>
                        <span class="px-4 flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
