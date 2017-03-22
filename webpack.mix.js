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
//    entry: {
//        app: './resources/assets/js/app.js',
//     vendors: [
//         'jquery',
//         'jquery.easing',
//         'bootstrap-sass',
//         'baguettebox.js'
//       ]
// },
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
 .js('resources/assets/js/admin/app.js', 'public/js/admin')
 .sass('resources/assets/sass/app.scss', 'public/css')
 .sass('resources/assets/sass/admin/app.scss', 'public/css/admin');

 //if(mix.config.inProduction)
     //mix.version();
