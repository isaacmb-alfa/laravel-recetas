
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

mix.js('resources/js/app.js', 'public/js')
.vue()
.autoload({
    jquery: ['$', 'window.jQuery' ,'jQuery']
});
mix.sass('resources/sass/app.scss', 'public/css');

mix.options({
    vue: {
        compilerOptions: {
            isCustomElement: tag => tag === 'trix-editor'
        }
    }
})

mix.webpackConfig({
    watchOptions: { ignored: /node_modules/ }
});
mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.DefinePlugin({
                __VUE_OPTIONS_API__: true,
                __VUE_PROD_DEVTOOLS__: false
            })
        ]
    };
});
mix.browserSync('http://recetaslaravel.test/');
