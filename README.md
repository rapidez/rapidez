# Rapidez - Headless Magento 🚀

With Laravel, Vue and Reactive Search 🤘🏻 Demo: https://test.rapidez.io 🏎

## Background

The idea behind Rapidez is to have a blazing fast headless frontend for your Magento 2 webshop which should be very easy to customize. The frontend is seperated from the Magento installation and communication between them is done via the Magento API. To speed things up we're also querying the Magento database to get catalog information for example. For category pages and the filters we're using Reactive Search which uses ElasticSearch as database. Indexation is also taken care of and is pretty fast.

## Setup

- `cp .env.example .env`
- Add the url and database credentials from your Magento 2 installation (or use the demo installation which will be running on `http://localhost:1234` after the Docker steps).
- `composer install`
- `php artisan key:generate`
- `yarn`
- `yarn run prod`
- `docker-compose up -d` (or bring your own Elasticsearch and Magento 2 installation)
- If you're using the Magento 2 Docker installation some additional steps are required:
    - `docker exec magento ./change-base-url http://localhost:1234/`
    - `docker exec magento ./install-sample-data`
    - `docker exec magento ./enable-flat-catalog`
    - `docker exec magento magerun2 indexer:reindex`
- `php artisan index:products`
- See it in the browser 🚀

### CORS

Because we're making Ajax request to the Magento API; CORS need to be opened. If you're using Valet Plus this can easily done, [see here](https://github.com/weprovide/valet-plus/issues/493). With the Docker Magento installation it's already opened [with a patch](https://github.com/michielgerritsen/magento2-extension-integration-test/blob/master/magento/patches/cors.patch). For production you've to restrict this to your domain.

## Extensions

The idea is to have a base application which can be extended with extensions. Those extensions currently house within the `extensions` directory. Later on this should be moved to Composer packages. Until then these extensions can be enabled/disabled by their service providers in `config/app.php`.

To keep everything as flexible as possible when a extension is enabled only the functional part of it will be active. The visual part needs to be registered manually so it can be customized however, and placed wherever wanted. Read for example the "Compare extension" readme at `extensions/Compare/README.md`. So a developer does have multiple options:

- Use the Vue components from the extension (and optionally customize it with props and/or slots)
- Create a new Vue component (and optionally use the extension mixins)

So when developing extensions make sure the Vue components are as flexible as possible and the functional part is seperated from the visual part. Styling should be project independent in the extensions!

## FAQ

**How is this different from Vue Storefront?**

> Vue Storefront does support multiple backends where the focus of Rapidez is Magento 2. The learning curve of Vue Storefront can be steep because it's totally different from Magento which uses a PHP stack. Rapidez combines best of both worlds by using PHP and Vue.

**Why headless and not a PWA?**

> Do you really need a offline experience on your webshop? PWA makes things more complicated than necessary.

**Do I need to know Vue?**

> No, Vue is only used for some functional frontend components like the cart. All Vue components are "renderless" so most likely you never need to touch them because all the HTML is in the Blade files. But some basic knowledge of Vue could be useful.

**TailwindCSS is used, do I need to use it?**

> No, you do not need te use it. You are completely free to use whatever you want. We like it so we used it for basic styling.

## Running on a server / going live

### Magento 2 Docker installation

This is only needed if you're using the Magento 2 Docker image with sample data for testing. Otherwise you're using your own Magento 2 installation. But keep in mind; you've to open CORS for the API calls.

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

### Elasticsearch

You've to secure your Elasticsearch instance so other people cannot manipulate the data in it as it need to be exposed.

- If you're using a Docker container, jump into it: `docker exec -it elasticsearch /bin/bash`
- Enable security in `config/elasticsearch.yml` with: `xpack.security.enabled: true`
- Change `http.cors.allow-origin` to your domain.
- Setup a password with `bin/elasticsearch-setup-passwords auto` (or use `interactive` to choose the passwords yourself)
- Restart Elasticsearch, with Docker: `docker restart elasticsearch`
- Edit your `.env` and add the credentials:
```
ELASTICSEARCH_USER=elastic
ELASTICSEARCH_PASS=YOUR-PASSWORD
```
- Create a proxy (with SSL) on a subdomain (as mentioned earlier this is really easy with Laravel Forge):
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
