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
    .js('resources/js/media-upload.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .setPublicPath('public')
    .options({
        processCssUrls: false, // Empêche la modification des chemins d'URLs
    });

    mix.webpackConfig({
        module: {
            rules: [
                {
                    test: /\.scss$/,
                    use: [
                        {
                            loader: 'sass-loader',
                            options: {
                                sassOptions: {
                                    quietDeps: true, // Masque les warnings des dépendances
                                },
                            },
                        },
                    ],
                },
            ],
        },
    });