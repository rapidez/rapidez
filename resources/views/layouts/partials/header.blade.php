<div class="flex flex-wrap items-center mb-5 bg-secondary">
    <div class="w-3/12">
        <div class="text-4xl ml-3">
            <a href="/">Rapidez</a>
        </div>
    </div>
    <div class="w-6/12 h-12 flex items-center">
        @include('layouts.partials.header.autocomplete')
    </div>
    <div class="w-2/12">
        <account-menu class="float-right"></account-menu>
    </div>
    <div class="w-1/12">
        @include('layouts.partials.header.minicart')
    </div>
    <div class="w-full">
        <x-menu/>
    </div>
</div>
