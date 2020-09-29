<?php

namespace Extensions\ImageResizer\Exceptions;

use Exception;

class UnreachableUrl extends Exception
{
    public static function create(string $url): self
    {
        return new static("Url `{$url}` cannot be reached");
    }
}
