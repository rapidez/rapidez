<div class="grid gap-5 sm:grid-cols-2">
    <x-category.block
        title="New Luma Yoga Collection"
        description="Get fit and look fab in new seasonal styles"
        image="/storage/resizes/750/home1.jpg.webp"
        link="/collections/yoga-new"
        button="Shop New Yoga"
    />
    <x-category.block
        title="Men Tops Collection"
        description="Find conscientious, comfy clothing"
        image="https://images.unsplash.com/photo-1578932750294-f5075e85f44a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80"
        link="/men/tops-men"
        button="Shop Men Tops"
    />
    <x-category.block
        title="Even more ways to mix and match"
        description="Buy 3 Luma tees get a 4th free"
        image="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
        link="/promotions/tees-all"
        button="Shop Tees"
    />
</div>

<div class="my-16 bg-white">
    <div class="grid grid-cols-2 gap-8 md:grid-cols-6">
        @foreach (['laravel', 'vue', 'tailwind-css', 'reactive-search', 'justbetter', 'magento'] as $brand)
            <div class="col-span-1 flex justify-center gap-8 md:col-span-2 lg:col-span-1">
                <img
                    class="h-12 max-w-[140px]"
                    src="https://rapidez.io/img/{{ $brand }}.svg"
                    alt="{{ $brand }}"
                    loading="lazy"
                >
            </div>
        @endforeach
    </div>
</div>

<div class="my-10">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-5 xl:gap-8">
        <x-category.card
            title="See our sale"
            image="https://images.unsplash.com/photo-1607083206869-4c7672e72a8a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
            link="/sale.html"
        />
        <x-category.card
            title="Browse our pants"
            image="https://images.unsplash.com/photo-1542272604-787c3835535d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1026&q=80"
            link="/promotions/pants-all.html"
        />
        <x-category.card
            title="Browse our shirts"
            image="https://images.unsplash.com/photo-1562157873-818bc0726f68?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=627&q=80"
            link="/promotions/tees-all.html"
        />
        <x-category.card
            title="Browse our fitness equipment"
            image="https://images.unsplash.com/photo-1584735935682-2f2b69dff9d2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1471&q=80"
            link="/gear/fitness-equipment.html"
        />
        <x-category.card
            title="Browse our yoga collection"
            image="https://images.unsplash.com/photo-1591291621060-89264efbeaed?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
            link="/collections/yoga-new.html"
        />
    </div>
</div>
