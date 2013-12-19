<?php
/**
 * restConfig.php  file.
 *
 * REST CONFIGURATION
 *
 * @author Spiros Kabasakalis <kabasakalis@gmail.com>
 * @copyright Copyright &copy; Spiros Kabasakalis 2013-
 * @link  InfoWebSphere,http://iws.kabasakalis.gr
 * @link  YiiLab,http://yiilab.kabasakalis.tk
 * @link  Github,https://github.com/drumaddict
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package
 * @version 1.0.0
 */

return array(

    'RestfullYii' => array(
        'config.application.id' => function () {
                return 'MUSIC_DB';
            },
        'req.auth.username' => function () {
                return 'demo@demo';
            },
        'req.auth.password' => function () {
                return   'demo';
            },
        'req.auth.user' => function ($application_id, $username, $password) {
                $requestHeadersArray = getallheaders();
                $username_header_key = 'HTTP_X_' . $application_id . '_USERNAME';
                $password_header_key = 'HTTP_X_' . $application_id . '_PASSWORD';
                if (!isset($requestHeadersArray[$username_header_key]) || !isset($requestHeadersArray[$password_header_key])) {
                    return false;
                }
                if ($username != $requestHeadersArray[$username_header_key]) {
                    return false;
                }
                if ($password != $requestHeadersArray[$password_header_key]) {
                    return false;
                }
                return true;
            },
        'req.auth.ajax.user' => function () {
         /*       BASIC AUTHORIZATION with hard coded $application_id, $username, $password
                If not under SSL,not so secure.(as a matter of fact,some would say not secure even under SSL)
                unfortunately I had to hardcode username,password,and app_id
                because the signature of this function event does not have
                $application_id, $username, $password arguments like req.auth.user :/
                In real application  you should query your database for $USERNAME,$PASSWORD*/

                $USERNAME='demo@demo';
                $PASSWORD='demo';
                $APP_ID='MUSIC_DB';
                $requestHeadersArray = getallheaders();
                $username_header_key = 'HTTP_X_' . $APP_ID . '_USERNAME';
                $password_header_key = 'HTTP_X_' . $APP_ID . '_PASSWORD';

                if (!isset($requestHeadersArray[$username_header_key]) || !isset($requestHeadersArray[$password_header_key])) {
                    return false;
                }
                if ($USERNAME != base64_decode($requestHeadersArray[$username_header_key])) {
                    return false;
                }
                if ($PASSWORD != base64_decode($requestHeadersArray[$password_header_key])) {
                    return false;
                }
                return true;
                //the following is not stateless!-not so RESTy.
                /*if(Yii::app()->user->isGuest) {
                    return false;
                }*/
            },

    )

);