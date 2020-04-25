<?php

namespace Extensions\SnowdogMenu\Models;

use App\Scopes\ForCurrentStoreScope;
use App\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'menu_id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'snowmenu_menu';

    /**
     * The "boot" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new IsActiveScope);
        static::addGlobalScope(new ForCurrentStoreScope('snowmenu_store'));
    }

    /**
     * Get the items for the menu.
     */
    public function items()
    {
        return $this->hasMany(MenuItem::class, 'menu_id');
    }
}
