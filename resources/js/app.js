import "Vendor/rapidez/core/resources/js/app.js";
import "Vendor/rapidez/account/resources/js/callbacks.js";
import "Vendor/rapidez/wishlist/resources/js/wishlist.js";

try {
    Vue.component("stars", () =>
        import("Vendor/rapidez/reviews/resources/js/components/Stars.vue")
    );
    Vue.component("star-input", () =>
        import("Vendor/rapidez/reviews/resources/js/components/StarInput.vue")
    );
} catch (e) {}
