# Image resizer

Instead of just loading the full and big images from Magento this extension resizes the images. This works by passing the Magento image path through the image route: `/image/{size}/{file}`. Let's say a product image is located at: `https://magentowebsite.com/media/catalog/product/a/a/product-image.jpg` the path will be `/catalog/product/a/a/product-image.jpg`. To get this image with a maximum width of 200 pixels you go to: `/image/200/catalog/product/a/a/product-image.jpg`. If you also want to specify a maximum height: `/image/200x200/catalog/product/a/a/product-image.jpg`.

Keep in mind that you've to whitelist all sizes to avoid ddos attacks! Publish the config with `php artisan vendor:publish --provider="Extensions\ImageResizer\ImageResizerExtensionServiceProvider" --tag=config` and specify the sizes you want.

Images are downloaded from the media url (see `config/shop.php`) and stored in `/storage/app/public/resizes`. Make sure the storage is linked with `php artisan storage:link`.
