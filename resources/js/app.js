import "Vendor/rapidez/core/resources/js/app.js";

(() => import("Vendor/rapidez/account/resources/js/callbacks.js"))();
(() => import("Vendor/rapidez/wishlist/resources/js/wishlist.js"))();

const components = import.meta.glob(
    "Vendor/rapidez/reviews/resources/js/components/*.vue",
    {
        eager: true,
    }
);

for (const path in components) {
    Vue.component(
        path.split("/").pop().split(".").shift(),
        components[path].default
    );
}
