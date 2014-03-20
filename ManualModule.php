<?php
    /**
     * Class File
     * @author      Christopher Stebe <cstebe@iserv4u.com>
     * @link        https://github.com/Quexer69/yii-manual-widget
     * @copyright   Copyright &copy; 2013 iServ4u GbR
     * @package     quexer69/yii-manual-widget
     * @version     1.0.0
     *
     * @description TBD
     */

class ManualModule extends CWebModule
{

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level controllers and components
        $this->setImport(array(
            'manual.components.*',
        ));

        Yii::app()->clientScript->registerCss('ManualWidget',
            '[id^=manual_] ul li {'
            . 'list-style  : disc;'
            . '}' .
            '[id^=manual_] ol li {'
            . 'list-style  : disc;'
            . '}'
        );
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

}
