var Encore = require('@symfony/webpack-encore');

Encore
// the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    .addEntry('js/App', ['babel-polyfill', './assets/js/App.js'])

    .enableSassLoader()
    .enableSourceMaps(!Encore.isProduction())
    .cleanupOutputBeforeBuild()
    .enableVersioning(Encore.isProduction())
    .enableReactPreset()
    .configureBabel((babelConfig) => {
        if (Encore.isProduction()) {
            babelConfig.plugins.push(
                'transform-react-remove-prop-types'
            )
        }
    })
;

module.exports = Encore.getWebpackConfig();