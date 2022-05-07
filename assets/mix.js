const mix = require('laravel-mix');

mix.styles([
    'update/mymo/css/bootstrap.min.css',
    'update/styles/vendors/toastr/toastr.min.css',
    'update/mymo/css/customs.css',
    'update/mymo/css/style.css',
], 'public/jw-styles/themes/mymo/assets/css/main.css');

mix.combine([
    'packages/cms/src/resources/assets/styles/js/jquery-support.js',
    'update/mymo/js/bootstrap.min.js',
    'update/styles/vendors/toastr/toastr.min.js',
    'update/mymo/js/core.min.js',
    'update/mymo/js/lazysizes.min.js',
    'update/mymo/js/owl.carousel.min.js',
    'update/mymo/js/ajax-auth-script.js',
    'update/mymo/js/jwplayer-8.9.3.js',
    'update/mymo/js/player.min.js',
], 'public/jw-styles/themes/mymo/assets/js/main.js');