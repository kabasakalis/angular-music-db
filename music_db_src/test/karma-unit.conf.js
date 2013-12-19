module.exports = function (config) {
    config.set({
        files: [
            'libs/angular/angular.js',
            'libs/angular-ui-router/angular-ui-router_0312.js',
            'libs/angular-mocks/angular-mocks.js',
            'libs/restangular/dist/restangular.js',
            'libs/underscore/underscore.js',
            'libs/angular-table/angular-table.js',
            'libs/angular-animate/angular-animate.js',
            'libs/angularjs-country-select/angular.country-select.js',
            'libs/spinjs/spin.js',
            'libs/jquery/jquery.js',
            'libs/toastr/toastr.js',
            'js/app.js',
            'test/unit/**/*.js'
        ],
        basePath: '../',
        frameworks: ['jasmine'],
        reporters: ['progress'],
        browsers: ['Chrome'],
        autoWatch: false,
        singleRun: true,
        colors: true
    });
};