var Encore = require('@symfony/webpack-encore');

Encore
// the project directory where all compiled assets will be stored
    .setOutputPath('public/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    // will create public/build/app.js and public/build/app.css
    .addEntry('BeerWarehouse', './assets/js/BeerWarehouse.js')
    .addEntry('Jquery', './node_modules/gentelella/vendors/jquery/dist/jquery.min.js')
    .addEntry('Bootstrap', './node_modules/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js')
    .addEntry('FastClick', './node_modules/gentelella/vendors/fastclick/lib/fastclick.js')
    .addEntry('Nprogress', './node_modules/gentelella/vendors/nprogress/nprogress.js')
    .addEntry('ChartJs', './node_modules/gentelella/vendors/Chart.js/dist/Chart.min.js')
    .addEntry('GaugeJs', './node_modules/gentelella/vendors/gauge.js/dist/gauge.min.js')
    .addEntry('ProgressBar', './node_modules/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.js')
    .addEntry('iCheck', './node_modules/gentelella/vendors/iCheck/icheck.js')
    .addEntry('Skycons', './node_modules/gentelella/vendors/skycons/skycons.js')
    .addEntry('Flot', './node_modules/gentelella/vendors/Flot/jquery.flot.js')
    .addEntry('FlotPie', './node_modules/gentelella/vendors/Flot/jquery.flot.pie.js')
    .addEntry('FlotTime', './node_modules/gentelella/vendors/Flot/jquery.flot.time.js')
    .addEntry('FlotStack', './node_modules/gentelella/vendors/Flot/jquery.flot.stack.js')
    .addEntry('FlotResize', './node_modules/gentelella/vendors/Flot/jquery.flot.resize.js')
    .addEntry('FlotOrderBars', './node_modules/gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js')
    .addEntry('FlotSpline', './node_modules/gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js')
    .addEntry('FlotCurvedLines', './node_modules/gentelella/vendors/flot.curvedlines/curvedLines.js')
    .addEntry('DateJs', './node_modules/gentelella/vendors/DateJS/build/production/date.min.js')
    .addEntry('Vmap', './node_modules/gentelella/vendors/jqvmap/dist/jquery.vmap.js')
    .addEntry('VmapWorld', './node_modules/gentelella/vendors/jqvmap/dist/maps/jquery.vmap.world.js')
    .addEntry('VmapSampleData', './node_modules/gentelella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')
    .addEntry('Moment', './node_modules/gentelella/vendors/moment/min/moment-with-locales.min.js')
    // .addEntry('DateRangePicker', './node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js')
    .addEntry('Gentlelella', './node_modules/gentelella/src/js/custom.js')
    .addEntry('Global', './assets/global.scss')

    // enable source maps during development
    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()

    // create hashed filenames (e.g. app.abc123.css)
    .enableVersioning()

    // allow sass/scss files to be processed
    .enableSassLoader(function(sassOptions) {}, {
        resolveUrlLoader: false
    });

// export the final configuration
module.exports = Encore.getWebpackConfig();
