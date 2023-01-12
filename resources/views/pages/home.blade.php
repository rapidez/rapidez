<div class="grid gap-5 sm:grid-cols-2">
    <x-category-block
        title="New Luma Yoga Collection"
        description="Get fit and look fab in new seasonal styles"
        image="https://images.unsplash.com/photo-1547949003-9792a18a2601?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
        link="/collections/yoga-new"
        button="Shop New Yoga"
    />
    <x-category-block
        title="Men Tops Collection"
        description="Find conscientious, comfy clothing"
        image="https://images.unsplash.com/photo-1486401899868-0e435ed85128?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80"
        link="/men/tops-men"
        button="Shop Men Tops"
    />
    <x-category-block
        title="Even more ways to mix and match"
        description="Buy 3 Luma tees get a 4th free"
        image="https://images.unsplash.com/photo-1577655197620-704858b270ac?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1280&q=144"
        link="/promotions/tees-all"
        button="Shop Tees"
    />
</div>

<div class="my-6 bg-white">
    <div class="grid grid-cols-2 gap-8 md:grid-cols-6">
        @foreach (['laravel', 'vue', 'tailwind-css', 'reactive-search', 'justbetter', 'magento'] as $brand)
            <div class="col-span-1 flex justify-center md:col-span-2 lg:col-span-1">
                <img
                    class="h-12 w-36"
                    src="https://rapidez.io/img/{{ $brand }}.svg"
                    alt="{{ $brand }}"
                    loading="lazy"
                >
            </div>
        @endforeach
    </div>
</div>
