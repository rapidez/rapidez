@props(['title', 'image', 'link'])

<a
    class="group relative overflow-hidden sm:rounded-xl"
    href="{{ $link }}"
>
    <div class="group absolute inset-0 flex items-end justify-center p-8">
        <div
            class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-50 transition group-hover:opacity-20">
        </div>
        <div class="z-10 text-xl font-bold text-white">{{ $title }}</div>
    </div>
    <img
        class="h-80 w-full object-cover"
        src="{{ $image }}"
        alt=""
    />
</a>
