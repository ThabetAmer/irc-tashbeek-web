const mix = require('laravel-mix');
const WebpackShellPlugin = require('webpack-shell-plugin');

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
  .js('resources/js/app.js', 'public/js/app.js')
  .sass('resources/sass/app.scss', 'public/css').options({
  processCssUrls: false,
  postCss: [
    tailwindcss('./tailwind_config.js'),
  ]
});

if (process.env.NODE_ENV === 'development') {
  mix.webpackConfig({
    module: {
      rules: [
        {
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /node_modules/
        },
      ],
    },
  });
}

mix.webpackConfig({
  plugins:
    [
      new WebpackShellPlugin({onBuildStart: ['php artisan lang:js -c public/js/messages.js --quiet'], onBuildEnd: []})
    ]
});