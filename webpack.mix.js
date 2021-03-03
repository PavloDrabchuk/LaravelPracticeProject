const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('storage/app/public/js/main.js', 'public/js')
    .js('storage/app/public/js/moment.js', 'public/js')
    .js('storage/app/public/js/bootstrap-datetimepicker.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css',
        [
            require('postcss-import'),
            require('tailwindcss'),
            require('autoprefixer'),
        ])
    .postCss('storage/app/public/css/theme.css', 'public/css')
    .postCss('storage/app/public/css/font-face.css', 'public/css')
    .postCss('storage/app/public/css/bootstrap-datetimepicker.min.css', 'public/css')


