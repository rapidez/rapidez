<div class="grid gap-5 sm:grid-cols-2">
    <x-category.block
        title="New Luma Yoga Collection"
        description="Get fit and look fab in new seasonal styles"
        image="/storage/{{ config('rapidez.store') }}/resizes/750/local/home1.jpg.webp"
        link="/collections/yoga-new"
        button="Shop New Yoga"
    />
    <x-category.block
        title="Men Tops Collection"
        description="Find conscientious, comfy clothing"
        image="/storage/{{ config('rapidez.store') }}/resizes/750/local/home2.jpg.webp"
        link="/men/tops-men"
        button="Shop Men Tops"
    />
    <x-category.block
        title="Even more ways to mix and match"
        description="Buy 3 Luma tees get a 4th free"
        image="/storage/{{ config('rapidez.store') }}/resizes/1500/local/home3.jpg.webp"
        link="/promotions/tees-all"
        button="Shop Tees"
    />
</div>

<div class="bg-white w-full py-20">
    <p class="text-center text-base font-semibold uppercase text-gray-600 tracking-wider">
        @lang('Built with / supported by')
    </p>
    <div class="mt-6 lg:mt-8 flex flex-wrap sm:text-lg">
        <div class="flex justify-center items-center py-8 px-8 lg:px-24 bg-gray-100 w-1/2 md:w-1/3 border-solid border-white border-2">
            <img class="h-12" src="https://rapidez.io/img/laravel.svg" alt="Laravel" loading="lazy">
        </div>
        <div class="flex justify-center items-center py-8 px-8 lg:px-24 bg-gray-100 w-1/2 md:w-1/3 border-solid border-white border-2">
            <img class="h-12 mr-3" src="https://rapidez.io/img/vue.svg" alt="Vue" loading="lazy">
        </div>
        <div class="flex justify-center items-center py-8 px-8 lg:px-24 bg-gray-100 w-1/2 md:w-1/3 border-solid border-white border-2">
            <img class="h-12" src="https://rapidez.io/img/tailwind-css.svg" alt="Tailwind CSS" loading="lazy">
        </div>
        <div class="flex justify-center items-center py-8 px-8 lg:px-24 bg-gray-100 w-1/2 md:w-1/3 border-solid border-white border-2">
            <img class="h-12 mr-3" src="https://rapidez.io/img/instantsearch.svg" alt="InstantSearch" loading="lazy">
        </div>
        <div class="flex justify-center items-center py-8 px-8 lg:px-24 bg-gray-100 w-1/2 md:w-1/3 border-solid border-white border-2">
            <img class="h-12" src="https://rapidez.io/img/justbetter.svg" alt="JustBetter" loading="lazy">
        </div>
        <div class="flex justify-center items-center py-8 px-8 lg:px-24 bg-gray-100 w-1/2 md:w-1/3 border-solid border-white border-2">
            <img class="h-12" src="https://rapidez.io/img/magento.svg" alt="Magento" loading="lazy">
        </div>
    </div>
</div>
