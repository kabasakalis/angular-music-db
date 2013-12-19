/**
 *  File App.ts in Project Music Database
 *  Date: October 12 th 2013 , 3:39 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */

/// <reference path='_refs.ts' />

module music_db {
    'use strict';

    export class App {

        public static controllers:ng.IModule = angular.module(config.Constants.APP_CONTROLLERS_MODULE, []);
        public static models:ng.IModule = angular.module(config.Constants.APP_MODELS_MODULE, []);
        public static directives:ng.IModule = angular.module(config.Constants.APP_DIRECTIVES_MODULE, []);
        public static services:ng.IModule = angular.module(config.Constants.APP_SERVICES_MODULE, []);
        public static providers:ng.IModule = angular.module(config.Constants.APP_PROVIDERS_MODULE, []);
        public static  filters:ng.IModule = angular.module(config.Constants.APP_FILTERS_MODULE, []);

        public static  ng_app_module:ng.IModule;

        public static defineModules():void{
            //register controllers
            this.controllers.controller('baseCtrl', ctrl.BaseCtrl);
            this.controllers.controller('artistCtrl', ctrl.ArtistCtrl);
            this.controllers.controller('artistFormCtrl', ctrl.ArtistFormCtrl);
            this.controllers.controller('albumsCtrl', ctrl.AlbumsCtrl);
            this.controllers.controller('albumFormCtrl', ctrl.AlbumFormCtrl);
            this.controllers.controller('tracksCtrl', ctrl.TracksCtrl);
            this.controllers.controller('tracksFormCtrl', ctrl.TracksCtrl);
            //register services
            this.services.service('Resource', music_db.svc.Resource);
            this.services.service('Noty', utils.Noty);

            //register directives
            this.directives.directive('executeClickOnce', () => {
                return  dir.ExecuteClickOnce.register();
            });
            this.directives.directive('ngSpinner', ['$window', function (win) {
                return dir.NgSpinner.register(win);
            } ]);

            //define main application module
            this.ng_app_module = angular.module(
                config.Constants.APP_MODULE,
                [
                    config.Constants.APP_CONTROLLERS_MODULE,
                    config.Constants.APP_MODELS_MODULE,
                    config.Constants.APP_DIRECTIVES_MODULE,
                    config.Constants.APP_SERVICES_MODULE,
                    config.Constants.APP_PROVIDERS_MODULE,
                    config.Constants.APP_FILTERS_MODULE,
                    'ui.router',
                    'ngAnimate',
                    'restangular',
                    'angular-table',
                    'countrySelect',
                   //'templates-main'      //don't enable this module when you are developing,or doing tests.
                                                              // it's caching partials into partials/views.js.Uncomment only when you are ready for production.

                ]
            );
        }


        public static config():void{

            //configure Location
            config.LocationConfig.configure(this.ng_app_module);

            //configure states
            config.UIRouter.configure(this.ng_app_module);
        }


        public static run():void {
            //run block
            Run.go(this.ng_app_module);
        }

        public static restangularConfig():void {
            //configure Restangular
            config.RestangularConfig.configure(this.ng_app_module);
        }

        public static start():void {
            //kick off angular app
            angular.bootstrap(document, [config.Constants.APP_MODULE]);
            // console.log('App started');
        }

    }

}