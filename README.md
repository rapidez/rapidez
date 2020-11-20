<p align="center"><a href="https://rapidez.io" target="_blank"><img src="https://raw.githubusercontent.com/rapidez/art/master/logo.svg" width="400"></a></p>

# Rapidez - Headless Magento 🚀

With Laravel, Vue and Reactive Search 🤘🏻 [Demo](https://test.rapidez.io) 🏎

The idea behind Rapidez is to have a blazing fast headless frontend for your Magento 2 webshop which should be very easy to customize. The frontend is seperated from the Magento installation and communication between them is done via the Magento API. To speed things up we're also querying the Magento database to get catalog information for example. For category pages and the filters we're using Reactive Search which uses ElasticSearch as database. Indexation is also taken care of and is pretty fast.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
    - [Demo Magento 2 shop](#demo-magento-2-shop)
    - [CORS](#cors)
    - [Multistore](#multistore)
- [Packages](#packages)
    - [Create your own package](#create-your-own-package)
    - [Events](#events)
- [Theming](#theming)
    - [Views](#views)
    - [CSS](#css)
    - [JS](#js)
- [FAQ](#faq)
- [Troubleshooting](#troubleshooting)
- [Deploying on a server](#deploying-on-a-server)
    - [Elasticsearch](#secure-elasticsearch)

## Requirements

- [Laravel requirements](https://laravel.com/docs/8.x/installation#server-requirements)
- PHP >= 7.4
- MySQL >= 5.7.13
- Elasticsearch >= 7.6
- Magento 2 installation ([or use a demo shop](#demo-magento-2-shop)) with flat tables enabled

## Installation

- `composer create-project rapidez/rapidez rapidez`
- Add the url and database credentials from your Magento 2 installation to the `.env`
- `yarn`
- `yarn run prod`
- `php artisan storage:link`
- `php artisan index:products`
- See it in the browser 🚀

### Demo Magento 2 shop

If you do not have a Magento 2 installation yet, you want to test Rapidez or like to develop with a fresh Magento 2 installation you can use a Magento 2 and Elasticsearch installation in a Docker container.

- Make sure Docker can use at least 4GB of memory
- `docker-compose up -d`
- `docker exec magento ./change-base-url http://localhost:1234/`
- `docker exec magento ./install-sample-data`
- `docker exec magento ./enable-flat-catalog`
- `docker exec magento magerun2 indexer:reindex`
- Edit the `.env`:
```
MAGENTO_URL=http://localhost:1234
DB_PORT=3307
DB_DATABASE=magento
DB_USERNAME=magento
DB_PASSWORD=password
```

### CORS

#### Magento

Because we're making Ajax request to the Magento API; CORS need to be opened. If you're using Valet Plus this can easily done, [see here](https://github.com/weprovide/valet-plus/issues/493). With the Docker Magento installation it's already opened [with a patch](https://github.com/michielgerritsen/magento2-extension-integration-test/blob/master/magento/patches/cors.patch). For production you've to restrict this to your domain.

#### Elasticsearch

If you're using your own Elasticsearch installation you've to open CORS in `elasticsearch.yml` and restart Elasticsearch. An example can be found in the root of this project. That configuration is used when you're using Elasticsearch from our Docker Compose config.

### Multistore

When you've setup multiple stores in Magento then Rapidez needs to know which store to show. Rapidez listens to the `MAGE_RUN_CODE` like Magento does. So just set that variable from your webserver.

## Packages

We provide some packages, see: https://github.com/rapidez. Did you create a package? Let us know!

### Create your own package

This works just like any Laravel package, read their documentation to get started: https://laravel.com/docs/master/packages

### Events

[Eventy](https://github.com/tormjens/eventy) is used to have Wordpress style filters which can be used within packages.

Filter | Explanation
--- | ---
`product.scopes` | Add additional global product scopes
`product.casts` | Add additional global product casts
`index.product.scopes` | Add product scopes to the product query when indexing
`index.product.data` | Manipulate the product data before it's getting indexed 
`index.product.attributes` | Index additional product attributes

## Theming

The base theming is located within `rapidez/core` but you can create your own package with all the views, css and js.

### Views

To change the views you can publish them with:
```
php artisan vendor:publish --provider="Rapidez\Core\RapidezServiceProvider" --tag=views
```

### CSS

Use TailwindCSS as we've done with the base styling or change the `webpack.mix.js` file and use whatever you want. Have a look at the [Laravel Mix docs](https://laravel.com/docs/8.x/mix) for all the available options.

### JS

In `resources/js/app.js` you'll find some requirements like Vue and Reactive Search but everything else can be changed, overwrite or extend.

## FAQ

**Why is it so fast?**

> Because we do not use the whole frontend stack from Magento. Just Laravel which queries the Magento database directly and the Magento API for the cart and checkout. Category filters are so fast because of Reactive Search which uses Elasticsearch as database. For the smooth page transitions we use Turbolinks.

**How is this different from Vue Storefront?**

> Vue Storefront does support multiple backends where the focus of Rapidez is Magento 2. The learning curve of Vue Storefront can be steep because it's totally different from Magento which uses a PHP stack. Rapidez combines best of both worlds by using PHP and Vue.

**Why headless and not a PWA?**

> Do you really need a offline experience on your webshop? PWA makes things more complicated then necessary.

**Do I need to know Vue?**

> No, Vue is only used for some functional frontend components like the cart. All Vue components are "renderless" so most likely you never need to touch them because all the HTML is in the Blade files. But some basic knowledge of Vue could be useful.

**TailwindCSS is used, do I need to use it?**

> No, you do not need te use it. You are completely free to use whatever you want. We like it so we used it for basic styling.

**Is it production ready?**

> If it fits your needs; yes. But most likely something is missing for you, please let us know what so we can work on it.

## Troubleshooting

- Make sure Magento is working
- Clear the cache with `php artisan cache:clear`
- Reindex the products with `php artisan index:products --force`, the parameter `--force` recreates the whole index
- Clear the browser cache, in Google Chrome with the "Clear site data" button on the application tab in DevTools

## Deploying on a server

<details>
<summary>Do you want to run the Magento 2 Docker image?</summary>

Just proxy everything to a subdomain and use that domain as `MAGENTO_URL` in the `.env`. With Laravel Forge this is really easy; just create another website on your server, setup SSL and edit the Nginx config:
```
location / {
    proxy_pass http://127.0.0.1:1234;
    proxy_redirect off;
    proxy_read_timeout 60;
    proxy_connect_timeout 60;
    
    proxy_buffer_size 128k;
    proxy_buffers 4 256k;
    proxy_busy_buffers_size 256k;

    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-Proto $scheme;
    proxy_set_header Host $host;
}
```
Use the MySQL credentials from the image (the port forwarded is 3307! Not 3306):
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=magento
DB_USERNAME=magento
DB_PASSWORD=password
```
</details>

### Secure Elasticsearch

You've to secure your Elasticsearch instance so other people cannot manipulate the data in it as it need to be exposed.

- If you're using a Docker container, jump into it: `docker exec -it elasticsearch /bin/bash`
- Enable security in `config/elasticsearch.yml` with: `xpack.security.enabled: true`
- Change `http.cors.allow-origin` to your domain.
- Setup a password with `bin/elasticsearch-setup-passwords auto` (or use `interactive` to choose the passwords yourself)
- Restart Elasticsearch (with Docker: `docker restart elasticsearch`)
- Edit your `.env` and add the credentials:
```
ELASTICSEARCH_USER=elastic
ELASTICSEARCH_PASS=YOUR-PASSWORD
```
- Create a proxy (with SSL) on a subdomain:
```
location / {
    proxy_pass http://localhost:9200;
}
```
- Repeat this step for Kibana which should be running on port 5601
- Set the credentials in `config/kibana.yml`:
```
elasticsearch.username: "elastic"
elasticsearch.password: "YOUR-PASSWORD"
```
- Login to Kibana and go to Management > Roles
- Add a new role `web`. It only needs one index privilege; use a `*` for the indices and `read` as privilege.
- Create an user `web`, password `rapidez` and the `web` role
- Add this to your `.env`:
```
ELASTICSEARCH_URL=https://web:rapidez@elasticsearch.domain.com
```
