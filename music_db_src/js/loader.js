/**
 *  File loader.js  in Project Music Database
 *  Date: October 12 th 2013 , 3:42 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */

require.config({
    // Once you setup baseUrl
    // Relative urls continue to work normal (from source file).
    // However Non-relative URLs use this as base.
    // By default this is the location of requirejs.
    baseUrl: './js',
    paths: {




        jquery: '../libs/jquery/jquery',
        angular: '../libs/angular/angular',
      //  angular: '../../apps/ng-ts-seed/libs/angular/124/angular',
        angular_animate: '../libs/angular-animate/angular-animate',
        //angular_animate: '../../apps/ng-ts-seed/libs/angular/124/angular-animate',
        views:'../partials/views',
        restangular: '../libs/restangular/dist/restangular',
        underscore: '../libs/underscore/underscore',
        ui_router: '../libs/angular-ui-router/angular-ui-router_0312',
        angular_table: '../libs/angular-table/angular-table',
        country_select: '../libs/angularjs-country-select/angular.country-select',
       noty: '../libs/noty/js/noty/jquery.noty',
       // noty: '../../apps/ng-ts-seed/libs/noty/jquery.noty',
        noty_top: '../libs/noty/js/noty/layouts/top',
        noty_topleft: '../libs/noty/js/noty/layouts/topLeft',
        noty_topright: '../libs/noty/js/noty/layouts/topRight',
        noty_center: '../libs/noty/js/noty/layouts/center',
        noty_inline: '../libs/noty/js/noty/layouts/inline',
        noty_default: '../libs/noty/js/noty/themes/default',
        toastr: '../libs/toastr/toastr',
        spin: '../libs/spinjs/spin',
        angular_spin: '../libs/ng-spinner/angular-spinner'
    },

    // For legacy files that do not export anything you need shims
    // For root level exports. http://requirejs.org/docs/api.html#config-shim
    shim: {
        'app': {
            deps: ['angular', 'jquery', 'spin']
        },
        'bootstrap':{
            deps: ['app']
        },
        'ui_router': {
            deps: ['angular']
        },
        'restangular': {
            deps: ['angular', 'underscore']
        },
        'angular_table': {
            deps: ['angular']
        },
        'country_select': {
            deps: ['angular']
        },
        'angular_animate': {
            deps: ['angular']
        },
        'angular_route': {
            deps: ['angular']
        },
        'views': {
            deps: ['angular']
        },
        //NOTY
        'noty': {
            deps: ['jquery']
        },
        'noty_top': {
            deps: [ 'noty']
        },
        'noty_topleft': {
            deps: [ 'noty']
        },
        'noty_topright': {
            deps: [ 'noty']
        },
        'noty_center': {
            deps: [ 'noty']
        },
        'noty_inline': {
            deps: [ 'noty']
        },
        'noty_default': {
            deps: [ 'noty', 'noty_top']
        },

        'toastr': {
            deps: ['jquery']
        },
        'spin': {   },
        'angular_spin': {
            deps: ['angular', 'spin']
        },
    },
    // Alternative to shim is something that jquery does. See bottom on jquery file.
});

// Start the app:
require([
    'jquery',
    'angular',
    'angular_animate',
 // 'views',     //templateCache  uncomment only when you compile for production(grunt prod)
    'ui_router',
    'underscore',
    'restangular',
    'angular_table',
    'country_select',
   'toastr',
    'spin',
    'noty',
    'noty_top',
    'noty_topleft',
    'noty_topright',
    'noty_center',
    'noty_inline',
    'noty_default',
    'app',
    'bootstrap'
],
    function () {
        return require(['bootstrap']);
    });