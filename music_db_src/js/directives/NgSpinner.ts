/**
 *  File NgSpinner.ts in Project Music Database
 *  Date: October 12 th 2013 , 3:39 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
module music_db.dir {
    'use strict';
    export class NgSpinner {
        public static $inject:Array<string> = ['$window'];
        public window;

        constructor($window) {
            this.window = $window;
        }

        static register = function (win) {
            var directive:ng.IDirective = {};
            directive.restrict = 'A';
            directive.priority = 1;
            directive.scope = {
                spinner_options: '=ngSpinner'
            };

            directive.link = function (scope, element, attr) {
                scope.spinner = null;
                function stopSpinner() {
                    if (scope.spinner) {
                        scope.spinner.stop();
                        scope.spinner = null;
                    }
                }
                scope.$watch('spinner_options', function (new_options, old_options) {
                    stopSpinner();
                    if (scope.spinner_options != null) {
                        scope.spinner = new win.Spinner(scope.spinner_options);
                        scope.spinner.spin(element[0]);
                    }
                }, true);
                scope.$on('$destroy', function () {
                    stopSpinner();
                });
            }
            return directive;
        }
    }

}