/**
 *  File Resource.ts in Project Music Database
 *  Date: October 12 th 2013 , 3:39 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */
module music_db.svc {
    'use strict';
    export class Resource {

        public static $inject:Array<string> = ['Restangular', '$window'];
        public    REST:Restangular;
        public win:any;

        constructor(Restangular, $window) {
            this.REST = Restangular;
            this.win = $window;
        }

        public stripRelated(resource_type, resource) {
            switch (resource_type) {
                case "artist":
                    return this.win._.omit(resource, 'genre', 'albums');
                    break;
                case "album":
                    return this.win._.omit(resource, 'genre', 'artists', 'tracks');
                    break;
                case "track":
                    return this.win._.omit(resource, 'album');
                    break;
                default:
                    return resource;
                    break;
            }
        }


        public   getAll(resource_type:string):ng.IPromise<any> {
            return  this.REST.all(resource_type).getList();
        }

        public    create(resource_type:string, resource):ng.IPromise<any> {
            return   this.REST.all(resource_type).post(resource);
        }

        public    delete(resource_type, id):ng.IPromise<any> {
            return   this.REST.one(resource_type, id).remove();
        }

        public    getById(resource_type, id):ng.IPromise<any> {
            return   this.REST.one(resource_type, id).get();
        }

        public   save(resource_type, resource):ng.IPromise<any> {
            var prepaired_resource = this.stripRelated(resource_type, resource);
            return this.REST.restangularizeElement(null, prepaired_resource, resource_type).put();
        }

        public  linkResourceToRelated(parent_resource_type, parent_resouce_id, resource_type, resource_id):ng.IPromise<any> {
            return this.REST.one(parent_resource_type, parent_resouce_id).
                one(resource_type + 's', resource_id).put();
        }

        public getAllRelatedByResourceId(resource_type, resource_id, related_type):ng.IPromise<any> {
            return     this.REST.one(resource_type, resource_id).all(related_type + 's').getList();
        }

        public   restangularize(resource_type, resource):RestangularElement {
            return   this.REST.restangularizeElement(null, resource, resource_type);
        }

    }

}