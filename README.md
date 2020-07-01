# Rapidez - Headless Magento 🏎

With Laravel, Vue and Reactive Search 🤘🏻

## Background

The idea behind Rapidez is to have a blazing fast headless frontend for your Magento 2 webshop which should be very easy to customize. The frontend is seperated from the Magento installation and communication between them is done via the Magento API. To speed things up we're also querying the Magento database to get catalog information for example. For category pages and the filters we're using Reactive Search which uses ElasticSearch as database. Indexation is also taken care of and is pretty fast.

## Setup

- `cp .env.example .env`
- Add the url and database credentials from the Magento installation
- `php artisan key:generate`
- `composer install`
- `yarn`
- `yarn run prod`
- `docker-compose up -d`
- `php artisan index:products`

### CORS

Because we're making Ajax request to the Magento API; CORS need to be opened. If you're using Valet Plus this can easily done, see: https://github.com/weprovide/valet-plus/issues/493

## Kibana

To explore the data in ElasticSearch you can use Kibana: http://localhost:5601

## Vue Storefront comparison

Vue Storefront does support multiple backends where the focus of Rapidez is Magento 2. The learning curve of Vue Storefront can be steep because it's totally different from Magento which uses PHP. Rapidez combines best of both worlds by using PHP and Vue. Just the interactive elements are written in Vue but the functional part is sepearted from the visual part so anyone without Vue knowledge can work with it.

## Extensions

The idea is to have a base application which can be extended with extensions. Those extensions currently house within the `extensions` directory. Later on this should be moved to Composer packages. Until then these extensions can be enabled/disabled by their service providers in `config/app.php`.

To keep everything as flexible as possible when a extension is enabled only the functional part of it will be active. The visual part needs to be registered manually so it can be customized however, and placed wherever wanted. Read for example the "Compare extension" readme at `extensions/Compare/README.md`. So a developer does have multiple options:

- Use the Vue components from the extension (and optionally customize it with props and/or slots)
- Create a new Vue component (and optionally use the extension mixins)

So when developing extensions make sure the Vue components are as flexible as possible and the functional part is seperated from the visual part. Styling should be project independent in the extensions!
