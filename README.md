# Running.shop Vue

## Setup

- `cp .env.example .env`
- Check the database credentials
- `php artisan key:generate`
- `composer install`
- `yarn`
- `yarn run prod`
- `docker-compose up -d`
- `php artisan index:products`

## Kibana

To explore the data in ElasticSearch you can use Kibana: http://localhost:5601

## Extensions

The idea is to have a base application which can be extended with extensions. Those extensions currently house within the `extensions` directory. Later on this should be moved to Composer packages. Until then these extensions can be enabled/disabled by their service providers in `config/app.php`.

To keep everything as flexible as possible when a extension is enabled only the functional part of it will be active. The visual part needs to be registered manually so it can be customized however, and placed wherever wanted. Read the "Compare extension" readme at `extensions/Compare/README.md`. So a developer does have multiple options:

- Use the Vue components from the extension (and optionally customize it with props and/or slots)
- Create a new Vue component (and optionally use the extension mixins)

So when developing extensions make sure the Vue components are as flexible as possible and the functional part is seperated from the visual part.
