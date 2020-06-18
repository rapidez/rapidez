<?php

namespace Extensions\SnowdogMenu\ViewComponents;

use Extensions\SnowdogMenu\Models\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class SnowdogMenuComponent extends Component
{
    public string $identifier;

    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    public function render(): string
    {
        $identifier = $this->identifier;

        return Cache::rememberForever('snowdogmenu.'.$identifier, function () use ($identifier) {
            $menu = Menu::where('identifier', $identifier)->firstOrFail();
            return view('snowdogmenu-extension::menu', [
                'items' => $this->convertToMenuTree($menu->items),
            ])->render();
        });
    }

    protected function convertToMenuTree($items, $parentId = null)
    {
        return $items->where('parent_id', $parentId)->map(function ($item) use ($items) {
            $item['children'] = $this->convertToMenuTree($items, $item->node_id);
            return $item;
        })->sortBy('position');
    }
}
