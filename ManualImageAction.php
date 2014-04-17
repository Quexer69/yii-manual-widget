<?php

/**
 * Created by PhpStorm.
 * User: chris
 * Date: 17.04.14
 * Time: 16:04
 */
class ManualImageAction extends CAction
{
    public $baseAlias;

    public function run()
    {
        if (isset($this->baseAlias) && Yii::getPathOfAlias($this->baseAlias) !== false) {
            $file = Yii::getPathOfAlias($this->baseAlias) . DIRECTORY_SEPARATOR . $_GET['img'];
            echo file_get_contents($file);
        } else {
            echo Yii::t('manual','No baseAlias defined');
        }
        Yii::app()->end();
    }
}