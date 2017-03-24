const { mix } = require('laravel-mix');

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

 let ImageminPlugin = require('imagemin-webpack-plugin').default;

 mix.webpackConfig( {
     plugins: [
         // Optimize images
         new ImageminPlugin( {
             disable: process.env.NODE_ENV !== 'production', // Disable during development
             test: /\.(jpe?g|png|gif|svg)$/i,
         } ),
     ],
 } )

 mix.copy('resources/assets/images', 'public/images', false)
 .js('resources/assets/js/app.js', 'public/js')
 .js('resources/assets/js/admin.js', 'public/js')
 .sass('resources/assets/sass/app.scss', 'public/css')
 .sass('resources/assets/sass/admin.scss', 'public/css');

 if(mix.config.inProduction)
     mix.version();
