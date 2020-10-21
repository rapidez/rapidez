<div class="flex flex-wrap items-center mb-5 border-b shadow">
    <div class="w-3/12">
        <div class="text-3xl ml-3">
            <a href="/">Rapidez</a>
        </div>
    </div>
    <div class="w-6/12 h-12 flex items-center">
        @include('layouts.partials.header.autocomplete')
    </div>
    <div class="w-3/12 flex justify-end pr-3">
        <account-menu class="my-1 mr-3"></account-menu>
        @include('layouts.partials.header.minicart')
    </div>
    <div class="w-full">
        <x-menu/>
    </div>
</div>
