<?php
/**
 * Clear_inactiveCommand.php  class file.
 *
 * Deletes users that have been not activated for longer than number of days specified.
 * Run this as a cron job
 *
 * @author Spiros Kabasakalis <kabasakalis@gmail.com>
 * @copyright Copyright &copy; Spiros Kabasakalis 2013-
 * @link  InfoWebSphere,http://iws.kabasakalis.gr
 * @link  YiiLab,http://yiilab.kabasakalis.tk
 * @link  Github https://github.com/drumaddict
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package
 * @version
 */

class Clear_inactiveCommand extends CConsoleCommand
{

    public function init() {
        echo "Deleting Inactive Users Older than days specified \n";
        parent::init();
    }

    public function actionDelete($days='1'){

                             $criteria = new CDbCriteria;
                             $criteria->condition = 'DATE_SUB(CURDATE(),INTERVAL '. $days.'  DAY) >= create_time AND status=:status';
                             $criteria->params = array(':status' => User::STATUS_INACTIVE);
                              $users = User::model()->findAll($criteria);
                              $result=array();
                              foreach ($users as $user) $result[]=$user->attributes;
                              print_r($result);
                              $users_deleted = User::model()->deleteAll($criteria);
                               echo ($users_deleted .' inactive users for longer than '.$days. ' day(s) deleted!');
    }

}
