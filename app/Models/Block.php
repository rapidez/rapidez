<?php

namespace App\Models;

use App\Models\Traits\HasContentAttributeWithVariables;
use App\Scopes\ForCurrentStoreScope;
use App\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasContentAttributeWithVariables;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cms_block';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'block_id';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new IsActiveScope);
        static::addGlobalScope(new ForCurrentStoreScope);
    }
}
