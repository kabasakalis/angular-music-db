/**
 *  File Constants.ts in Project Music Database
 *  Date: October 12 th 2013 , 3:42 PM
 *  Author Spiros Kabasakalis , kabasakalis@gmail.com
 *  Github https://github.com/drumaddict
 * InfoWebSphere,http://iws.kabasakalis.gr
 * YiiLab,http://yiilab.kabasakalis.tk
 */

module music_db.config {
    'use strict';
    export class Constants {

        public static APP_NAME = "Angular Music Database";
        public static APP_BASE_URL = "/music_db/";
        public static DOMAIN = "rest.dev";
        public static API_BASE_URL = "/api";//this is the API base url defined by RestfullYii extension on the backend.
        //if you change username and password ,you must also change them on server side.
        //If you stick with Yii on server side, see 'req.auth.ajax.user' function in   protected/config/restConfig.php.
        //Remember this is just a demo.If you want to keep the application RESTful,
        // you should expect user credentials from a login form,store them in cookie,and send them Base64 encrypted in headers with
        //SSL on every request.(Basic Authentication).
        public static USERNAME='demo@demo';
        public static PASSWORD='demo';
        public static APPLICATION_ID='MUSIC_DB';

        //store module names in constants.In case we want to change something to avoid collision.
        public static APP_MODULE = "ng_music_db";
        public static APP_CONTROLLERS_MODULE = "controllers";
        public static APP_MODELS_MODULE = "models";
        public static APP_DIRECTIVES_MODULE = "directives";
        public static APP_SERVICES_MODULE = "services";
        public static APP_PROVIDERS_MODULE = "providers";
        public static APP_FILTERS_MODULE = "filters";

    }
}