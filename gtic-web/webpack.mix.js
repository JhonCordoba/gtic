const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);

mix.js("resources/js/views/login/login.js", "public/js");

mix.js("resources/js/libraries/charts_loader.js", "public/js/libraries");

mix.js("resources/js/libraries/bootstrap_select.js", "public/js/libraries");

mix.sass("resources/sass/modalSystem.scss", "public/css");
