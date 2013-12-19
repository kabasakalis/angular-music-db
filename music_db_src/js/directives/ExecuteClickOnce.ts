/**
 *  File ExecuteClickOnce.ts in Project Music Database
 *  Date: October 12 th 2013 , 3:39 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
module music_db.dir {
    'use strict';
    export class ExecuteClickOnce {
        public static $inject:Array<string> = [];

        static register() {
            var directive:ng.IDirective = {};
            directive.restrict = 'A';
            directive.priority = 1;
            directive.link = function (scope, iElement, iAttrs) {
                $(iElement).one("click", function () {
                    scope.$apply(iAttrs.executeClickOnce);
                });
            }
            return directive;
        }

    }
}