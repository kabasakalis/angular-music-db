<?php
/**
 * index.php   file.
 *
 * @author Spiros Kabasakalis <kabasakalis@gmail.com>
 * @copyright Copyright &copy; Spiros Kabasakalis 2013-
 * @link  InfoWebSphere,http://iws.kabasakalis.gr
 * @link  YiiLab,http://yiilab.kabasakalis.tk
 * @link  Github https://github.com/drumaddict
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package
 * @version 2.0.0
 */
defined('BACKEND') or define('BACKEND',false);
defined('LOCAL_DOMAIN') or define('LOCAL_DOMAIN','rest.dev');
define('CURRENT_ACTIVE_DOMAIN', $_SERVER['HTTP_HOST']);
defined('APP_DEPLOYED') or define('APP_DEPLOYED',!(CURRENT_ACTIVE_DOMAIN == LOCAL_DOMAIN));
defined('DS') or define('DS',DIRECTORY_SEPARATOR);


//Local Framework Path
$yii=(!APP_DEPLOYED)?dirname(__FILE__).DS.'..'.DS.'frameworks'.DS .'yii_1.1.14'.DS .'framework'.DS .'yii.php':
//Server framework Path
dirname(__FILE__).DS.'..'.DS.'..'.DS.'frameworks'.DS .'yii_1.1.14'.DS .'framework'.DS .'yii.php';


$config=dirname(__FILE__).'/protected/config/main.php';
$shortcuts=dirname(__FILE__).DS.'protected'.DS .'helpers'.DS .'shortcuts.php';
$utils=dirname(__FILE__).DS.'protected'.DS .'helpers'.DS .'utils.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require($shortcuts);
require($utils);
require_once($yii);

Yii::createWebApplication($config)->run();
