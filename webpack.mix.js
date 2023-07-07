const mix = require("laravel-mix");

mix.js("resources/js/app.js", "dist/js/app.js")
    .vue({version: 2})
    .webpackConfig(require('./webpack.config'))
