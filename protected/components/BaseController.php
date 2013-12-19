<?php
/**
 * BaseController.php
 *
 * Date: 11/15/12
 * Time: 22:46 PM
 *
 * This controllers makes possible for controllers that extend from it to inherit
 * actions from behaviors
 *
 * Idea by Yii user Mimin and  Kevin Higgins
 * @link http://www.yiiframework.com/forum/index.php/user/9488-mimin/
 * @link http://www.yiiframework.com/forum/index.php/user/24587-kevin-higgins/
 * Relevant discussion in Yii Forum
 * @link http://www.yiiframework.com/forum/index.php/topic/10652-actions-by-behavioring/
 *
 */
class BaseController extends CController
{

    private $_behaviorIDs = array();


    public function  init()
    {
        parent::init();
    }

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/col2';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function createAction($actionID)
    {
        $action = parent::createAction($actionID);
        if ($action !== null)
            return $action;
        foreach ($this->_behaviorIDs as $behaviorID) {
            $object = $this->asa($behaviorID);
            if ($object->getEnabled() && method_exists($object, 'action' . $actionID))
                return new CInlineAction($object, $actionID);
        }
    }

    public function attachBehavior($name, $behavior)
    {
        $this->_behaviorIDs[] = $name;
        parent::attachBehavior($name, $behavior);
    }


}