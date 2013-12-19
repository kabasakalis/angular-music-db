/**
 *  File Run.ts in Project Music Database
 *  Date: October 13 th 2013 , 11:51 AM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */

    /// <reference path='_refs.ts' />

module music_db {
    'use strict';
    export class Run {

        public  mod:ng.IModule;

        public static go(mod:ng.IModule) {
            //console.log('Run configuration  block  started');

            mod.
                run(
                    [
                        '$rootScope',
                        '$state',
                        'Resource',
                        function ($rootScope,$state,Resource) {
                            $rootScope.$state=$state;
                            $rootScope.breadcrumbs=new Array();
                            $rootScope.APP_BASE_URL = config.Constants.APP_BASE_URL;
                            $rootScope.APP_NAME = config.Constants.APP_NAME;
                        }]); //run
        }
    }
}