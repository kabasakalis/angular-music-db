/**
 *  File Utils.ts in Project  ng-ts-seed
 *  Date: November 13 th 2013 , 9:46 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
    /// <reference path='../_refs.ts' />
module music_db.utils {
    'use strict';
    export class Utils {

        static parseServerErrorMessage = function (messageObject) {
            var stringErrorMessage = '';
            angular.forEach(messageObject, function (propertyMessageArray, propertyname) {
                angular.forEach(propertyMessageArray, function (message, key) {
                    stringErrorMessage += message + '\n';
                })
            });
            return stringErrorMessage;
        }

        public static     findByProperty(artists, prop, value):any {
            return window['_'].find(artists, function (artist) {
                return artist[prop] == value;
            })
        }

        public static  selectByRelatedResourceProperty(array_list, relatedResource, Property, Value):Object {

            return window['_'].select(array_list, function (resource) {
                if (!window['_'].isArray(resource[relatedResource]))  //if its a MANY relationship
                    return  resource[relatedResource][Property] == Value; else //if it's a HAS ONE relationship
                    return window['_'].find(resource[relatedResource], function (_relatedResource) {
                        return _relatedResource[Property] == Value;
                    });
            })
        }

        public static removeArrayElementWithId(List:any[], id:number):any[] {
            return window['_'].without(List, Utils.findByProperty(List, 'id', id));
        }

        public static removeArrayElementWithPropertyValue(List:any[], property:string, value:string):any[] {
            return window['_'].without(List, Utils.findByProperty(List, property, value));
        }

        public static    getClassName(ent:any):string {
            if (typeof ent == "string") return ent;

            if (ent.constructor && ent.constructor.name != "Function") {
                return ent.constructor.name || (ent.toString().match(/function (.+?)\(/) || [, ''])[1];
            } else {
                return ent.name;
            }
        }

    }
}