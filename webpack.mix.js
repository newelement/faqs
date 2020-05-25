const mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'publishable/assets/js')
    .js('resources/assets/js/admin.js', 'publishable/assets/js')
    .sass('resources/assets/sass/app.scss', 'publishable/assets/css')
    .sass('resources/assets/sass/admin.scss', 'publishable/assets/css');
