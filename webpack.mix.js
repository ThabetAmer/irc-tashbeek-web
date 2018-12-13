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
const tailwindcss = require('tailwindcss');

mix
    .js('resources/js/dashboard/app.js', 'public/js/dashboard.js')
    .js('resources/js/firm-profile/app.js','public/js/firmProfile.js')
    .js('resources/js/seeker-profile/app.js','public/js/seekerProfile.js')
    .js('resources/js/firms/app.js','public/js/firms.js')

    .sass('resources/sass/app.scss', 'public/css').options({
    processCssUrls: false,
    postCss: [
        tailwindcss('./tailwind_config.js'),
    ]
});
