<li class="{{ config('menu-extension.classes.'.$loop->depth.'.li') }}">
    <a class="{{ config('menu-extension.classes.'.$loop->depth.'.category') }}" href="{{ $item->url }}">
        {{ $item->name }}
    </a>
    @includeWhen($item->children->count(), 'menu-extension::menu', ['items' => $item->children])
</li>
