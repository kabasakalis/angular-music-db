/**
 *  File RestangularConfig.ts in Project Music Database
 *  Date: October 13 th 2013 , 11:51 AM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */

    /// <reference path='../_refs.ts' />

module music_db.config {
    'use strict';

    export class RestangularConfig {

        public  mod:ng.IModule;
        public static  spinner:any;

        constructor() {
            throw new Error("Cannot instantiate  this Class");
        }

        public static configure(mod:ng.IModule) {
            //console.log('Restangular Configuration started');
            mod.
                config(
                    [ 'RestangularProvider',
                        function (RestangularProvider) {
                            RestangularProvider.setBaseUrl('/api');
                            //   RestangularProvider.setDefaultHttpFields({cache: true});
                            RestangularProvider.setFullRequestInterceptor(function (element, operation, route, url, headers, params) {
                                utils.Spin.startGlobalSpinner(undefined, utils.Spin.options1);
                                //set Basic Authorization headers
                                var username_header_key = 'HTTP_X_' + Constants.APPLICATION_ID+ '_USERNAME';
                                var  password_header_key = 'HTTP_X_' + Constants.APPLICATION_ID+ '_PASSWORD';
                                headers[username_header_key]= music_db.utils.Base64.encode(Constants.USERNAME);
                                headers[password_header_key]=music_db.utils.Base64.encode(Constants.PASSWORD);

                                return {
                                    element: element,
                                    params: window['_'].extend(params, {}),
                                    headers:window['_'].extend(headers, {})
                                };
                            });

                            RestangularProvider.setResponseExtractor(function (response, operation, resource, url) {
                                if ( utils.Spin)   utils.Spin.stopGlobalSpinner();
                                if (response.data == undefined) utils.Toastr.show('error',
                                    'The Server has responded in an unpredictable manner.We are sorry for the inconvenience.',
                                    'Server Error Message');
                                var newResponse:any = {};
                                newResponse.data = {};
                                newResponse.meta = {};
                                // This is a get for a list
                                if (operation === "getList") {
                                    // Here we're returning an Array which has one special property meta with our extra information
                                    newResponse.data = response.data;
                                    newResponse.meta.totalCount = response.data.totalCount;
                                    newResponse.meta.message = response.data.totalCount + ' ' + resource + '(s) found.'
                                    newResponse.meta.success = response.success;

                                } else {  // This is an element

                                    var putMessage =  'Saved successfully.';
                                    var createdMessage = 'New  ' + resource[0].toUpperCase() + resource.slice(1) + ' has been created successfully';
                                    var deletedMessage = resource[0].toUpperCase() + resource.slice(1) + ' has been deleted successfully';
                                    var getMessage = resource[0].toUpperCase() + resource.slice(1) + ' has been retrieved  successfully';
                                    if (operation === "post")newResponse.meta.message = createdMessage;
                                    if (operation === "put")newResponse.meta.message = putMessage;
                                    if (operation === "remove")newResponse.meta.message = deletedMessage;
                                    if (operation === "get")newResponse.meta.message = getMessage;

                                    newResponse.data = response.data;
                                    newResponse.meta.totalCount = response.data.totalCount;
                                    newResponse.meta.success = response.success;

                                    utils.Toastr.show('success',
                                        newResponse.meta.message,
                                        'Server  Message');
                                }
                                return newResponse;
                            });

                            RestangularProvider.setErrorInterceptor(function (response) {
                                utils.Spin.stopGlobalSpinner();
                                var error_message:any;
                                var raw_error_message = response.data.message;
                                if (typeof raw_error_message !== 'undefined') {
                                    if (raw_error_message.charAt(0) !== '{') //server is returning a single message string
                                        error_message = raw_error_message; else {  //server is returning a stringified multi-message object,(server side validation errors)
                                        var error_message_Obj:any = JSON.parse(raw_error_message);
                                        error_message = utils.Utils.parseServerErrorMessage(error_message_Obj);
                                    }
                                }        //the server returned something other than a string,like a whole page
                                else error_message = "Unexpected Server Response.We are sorry for the inconvenience.";
                                utils.Toastr.show('error', error_message, 'Server Error Message');
                                //console.log(response,'response [setErrorInterceptor]');
                                // console.log(response.config.data,'response.config.data     [setErrorInterceptor]');
                                //console.log(response.config.method,'response.config.method  [setErrorInterceptor]');
                                //console.log(response.config.url,'response.config.url      [setErrorInterceptor]');
                                //console.log(response.data.message,'response.data.message  [setErrorInterceptor]');
                                //console.log(response.data.success,'response.data.success    [setErrorInterceptor]');
                                //console.log(response.status,'response.status  [setErrorInterceptor]');
                                //DO SOMETHING ON ERROR BASED ON THIS DATA
                            });
                        }]);
        }
    }
}