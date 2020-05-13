<?php

namespace App\Exceptions;

use Exception;

class NoAttributesToSelectSpecifiedException extends Exception
{
    public static function create(): self
    {
        return new static('You\'ve to specify the attributes to select with selectAttributes()');
    }
}
