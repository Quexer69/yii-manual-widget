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
        //        $cacheId = "MeridaManualWidget." . $_GET['img'];
        //        if ($cachedItems = Yii::app()->cache->get($cacheId)) {
        //            echo $cachedItems;
        //        } else {
        //            $file       = Yii::getPathOfAlias($this->baseAlias) . DIRECTORY_SEPARATOR . $_GET['img'];
        //            $outputFile = file_get_contents($file);
        //
        //            Yii::app()->cache->set($cacheId, $outputFile, 0, self::getMenuCacheDependency());
        //            echo $outputFile;
        //        }
        //        Yii::app()->end();

        $file = Yii::getPathOfAlias($this->baseAlias) . DIRECTORY_SEPARATOR . $_GET['img'];
        echo file_get_contents($file);

        Yii::app()->end();
    }
}