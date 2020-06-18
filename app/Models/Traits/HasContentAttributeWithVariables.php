<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;
use ReflectionClass;

trait HasContentAttributeWithVariables
{
    public function getContentAttribute(string $content): string
    {
        foreach (get_class_methods($this) as $method) {
            if (Str::startsWith($method, 'process')) {
                $content = $this->$method($content);
            }
        }

        return $content;
    }

    protected function processMediaAndStoreUrl(string $content): string
    {
        return preg_replace('/{{(media|store) url=("|&quot;|\')(.*?)("|&quot;|\')}}/m', config('shop.media_url') . '/${3}', $content);
    }

    protected function processStoreDirectUrl(string $content): string
    {
        return preg_replace('/{{store direct_url=("|&quot;|\')(.*?)("|&quot;|\')}}/m', config('app.url') . '/${2}', $content);
    }

    protected function processWidgets(string $content): string
    {
        return preg_replace_callback('/{{widget type="(.*?)" (.*?)}}/m', function ($matches) {
            [$full, $type, $parameters] = $matches;
            preg_match_all('/(.*?)="(.*?)"/m', $parameters, $parameters, PREG_SET_ORDER);
            foreach ($parameters as $parameter) {
                [$full, $parameter, $value] = $parameter;
                $options[trim($parameter)] = trim($value);
            }

            switch ($type) {
                default:
                    return '<i>The "'.$type.'" widget is not implemented yet.</i>';
            }
        }, $content);
    }
}
