<?php

namespace App\Exceptions;

use Exception;

class TestProductNotSetException extends Exception
{
    public static function create(): self
    {
        return new static('Set a product SKU with TESTING_PRODUCT in the .env');
    }
}
