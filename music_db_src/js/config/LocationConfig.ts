/**
 *  File LocationConfig.ts in Project Music Database
 *  Date: October 13 th 2013 , 11:51 AM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */

    /// <reference path='../_refs.ts' />

module music_db.config {
    'use strict';
    export class LocationConfig {
        public  mod:ng.IModule;

        constructor() {
            throw new Error("Cannot instantiate  this Class");
        }
        public static configure(mod:ng.IModule) {
        //console.log('Location configuration  started');

            mod.
                config(
                    [  '$locationProvider',
                        function ($locationProvider) {
                            //commenting out this line (switching to hashbang mode) breaks the app
                            //-- unless # is added to the templates
                            $locationProvider.html5Mode(true);
                            $locationProvider.hashPrefix('!');
                        }]); //config
        }
    }
}