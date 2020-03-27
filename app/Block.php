<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
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
     * Get the cms block content.
     *
     * @param  string  $value
     * @return string
     */
    public function getContentAttribute($value)
    {
        return preg_replace('/{{media url=&quot;(.*?)&quot;}}/m', config('shop.media_url') . '/${1}', $value);
    }
}
