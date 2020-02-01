const mix = require('laravel-mix')
require('laravel-mix-polyfill')

mix.browserSync('127.0.0.1:8000')

mix.js('resources/js/app.js', 'js')
   .sass('resources/sass/app.scss', 'css')
   .polyfill({
      enabled: true,
      useBuiltIns: "usage",
      targets: {
        "firefox": "50",
        "ie": 11
      }
   })

mix.sourceMaps()
mix.version()