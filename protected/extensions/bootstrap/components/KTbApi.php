<?php
/**
 *  class KTbapi
 *  @author: spiros kabasakalis <kabasakalis@gmail.com>
 * Date: 11/18/12
 * Time: 9:36 AM
 * Get the assets folder out from protected and into the webroot,so we don't have to publish it.
 * This is my personal preference,I hate "publishing assets".:P
 * And support Bootswatch themes (http://bootswatch.com/)
 */

class KTbapi extends TbApi
{



    /** PARENT
     * Registers the Bootstrap CSS.
     * @param string $url the URL to the CSS file to register.
     */
    public function registerCoreCss($url = null)
    {
        if ($url === null) {
            if (app()->params['bootswatch2_skin']=='none') {
            $fileName = YII_DEBUG ? 'bootstrap.css' : 'bootstrap.min.css';
                $url = $this->getAssetsUrl() . '/css/' . $fileName;
            } else
                $url = bu().'/libs/bootswatch/2/'.app()->params['bootswatch2_skin'].'/bootstrap.min.css';

        }
        Yii::app()->clientScript->registerCssFile($url);
    }

    protected function getAssetsUrl()
    {
        if (isset($this->_assetsUrl)) {
            return $this->_assetsUrl;
        } else {
            $assetsPath = Yii::getPathOfAlias('webroot.yiistrap_assets');
            $assetsUrl=bu().'/yiistrap_assets';
            return $this->_assetsUrl = $assetsUrl;
        }
    }
}
