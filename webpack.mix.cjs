const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [require('autoprefixer')],
    })
    .copy('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js/bootstrap.bundle.js')
    .version();

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.json', '.vue'],
    },
});
