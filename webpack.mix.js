let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */
mix.setPublicPath('./');

mix
    .postCss("assets/css/bee-rh.css", "dist/css/", [
        require("tailwindcss"),
    ])
    .js('assets/js/app.js', 'dist/js/app.min.js')
