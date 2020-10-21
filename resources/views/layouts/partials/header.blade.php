<div class="flex flex-wrap items-center mb-5 border-b shadow">
    <div class="w-1/6 sm:w-3/12">
        <div class="text-xl sm:text-3xl ml-3">
            <a href="/">
                <span class="hidden sm:inline">Rapidez</span>
                <span class="inline sm:hidden">🚀</span>
            </a>
        </div>
    </div>
    <div class="w-6/12 h-12 flex items-center">
        @include('layouts.partials.header.autocomplete')
    </div>
    <div class="w-1/3 sm:w-1/4 flex justify-end pr-3">
        @include('layouts.partials.header.account')
        @include('layouts.partials.header.minicart')
    </div>
    <div class="w-full">
        <x-menu/>
    </div>
</div>
