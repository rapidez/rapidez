<li class="{{ config('snowdogmenu-extension.classes.'.$loop->depth.'.li') }}">
    @if($item->type == 'wrapper')
        <div class="{{ $item->classes }}">
    @else
        {{ $item->html($loop) }}
    @endif
    @includeWhen($item->children, 'snowdogmenu-extension::menu', ['items' => $item->children])
    @if($item->type == 'wrapper')
        </div>
    @endif
</li>
