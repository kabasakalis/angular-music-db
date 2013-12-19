/**
 *  File Spin.ts in Project  ng-ts-seed
 *  Date: November 13 th 2013 , 9:46 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
module music_db.utils {
    'use strict';
    export class Spin {

        public static instance:any;

        public static defaultOptions:Object = {
            lines: 13, // The number of lines to draw
            length: 20, // The length of each line
            width: 10, // The line thickness
            radius: 30, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#fff', // #rgb or #rrggbb or array of colors
            speed: 1, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: 'auto', // Top position relative to parent in px
            left: 'auto' // Left position relative to parent in px
        }
        public static options1:Object = {
            lines: 17,
            radius: 30,
            width: 15,
            corners: 1.0,
            rotate: 29,
            length: 40,
            trail: 37,
            direction: 1,
            speed: 1.7,
            shadow: 'on',
            color: '#66ffff', // 66ffff(cyan)  ,b266ff(purple)
            opacity: 0.05,
            top: '100', // Top position relative to parent in px
            left: '440' // Left position relative to parent in px
        }

        public static startGlobalSpinner(containerID?:string, _options?:Object) {
            var options:Object = {};
            if (containerID === undefined) containerID = 'spinner_container';

            if (_options !== undefined || _options != null) options = angular.extend(Spin.defaultOptions, _options);
            else _options = Spin.defaultOptions;

            var target = document.getElementById(containerID);
            if ( Spin.instance !== undefined){
                        Spin.instance.spin(target);
            } else {
            Spin.instance = new window['Spinner'](options);
            Spin.instance.spin(target);
            }
        }


        public static stopGlobalSpinner() {
            Spin.instance.stop();
        }


        /*The following two functions are used to start a spinner locally,in a view with an associated controller.
         *The functions depend on  directives/Spin directive.
         * The controller class is expected to have a spinner_options member property defined,holding the spinner configuration options.
         * The view is expected to have an element with the directive attribute ng-spinner,with a value pointing to controller's
         *  spinner_options property mentioned above.
         *  For example
         * <span   ng-spinner="vm.spinner_options"></span>
         *  vm is a reference to the controller's instance, attached to the scope,and it is passed as an argument when calling the functions.
         *  Sometimes,when we  want to start a spinner during the application's configuration phase,the controller is not available,
         *  so these functions will not work and the global functions must be used instead.
         * */

        //options are optional,if not passed,spinner will be rendered with default options.
        public static startSpinner = function (vm:any, options?:Object) {

            if (options !== undefined)  vm.spinner_options = angular.extend(Spin.defaultOptions, options);
            else   vm.spinner_options = Spin.defaultOptions;
        }

        public static stopSpinner = function (vm:any) {
            vm.spinner_options = null;
        }

    }
}