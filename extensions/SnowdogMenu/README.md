# Snowdog Menu

A Blade component will be registered which can be used:
```
<x-snowdog-menu identifier="main"/>
```

## Configuration

You can change the classes with the configuration file by publishing it with `php artisan vendor:publish --provider="Extensions\SnowdogMenu\SnowdogMenuExtensionServiceProvider" --tag=config`.

## Full control

If you need more control you can publish the views as well with: `php artisan vendor:publish --provider="Extensions\SnowdogMenu\SnowdogMenuExtensionServiceProvider" --tag=views`
