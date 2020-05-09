<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;
use TorMorten\Eventy\Facades\Eventy;

class Model extends BaseModel
{
    public function getCasts(): array
    {
        return array_merge(parent::getCasts(), Eventy::filter('product.casts') ?: []);
    }
}
