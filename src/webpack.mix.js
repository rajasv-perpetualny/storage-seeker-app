const mix = require('laravel-mix');

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

mix.js('resources/default/assets/js/app.js', 'public/js')
    .js('resources/default/assets/js/reserve.js', 'public/js')
    .js('resources/default/assets/js/googlemaps.js','public/js')
    .js('resources/default/assets/js/starpicker.js','public/js')
    .js('resources/default/assets/js/searchfilters.js','public/js')
    .sass('resources/default/assets/sass/app.scss', 'public/css')
    .sass('resources/default/assets/sass/font-awesome.scss', 'public/css');
