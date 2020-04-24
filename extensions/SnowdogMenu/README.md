# Snowdog Menu

There is a `Menu.vue` component which can be used. Just register it in the `app.js`:
```
Vue.component('snowdog-menu', require('Extensions/SnowdogMenu/components/Menu.vue').default);
```
And use it in your header with `<snowdog-menu identifier="main"></snowdog-menu>`.

## Configuration

You can change the classes with the configuration file by publishing it with `php artisan vendor:publish --provider="Extensions\SnowdogMenu\SnowdogMenuExtensionServiceProvider" --tag=config`.

## Full control

If you need more control you can publish the views as well with: `php artisan vendor:publish --provider="Extensions\SnowdogMenu\SnowdogMenuExtensionServiceProvider" --tag=views`
