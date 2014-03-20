<?php
    /**
     * Created by PhpStorm.
     * User: chris stebe
     * Date: 20.03.14
     * Time: 16:01
     */

    $this->widget('application.components.manual-widget.ManualWidget', array(
            'manualHeader' => CHtml::image('https://owncloud.hrzg.de/public.php?service=files&t=40d03704c1df5211436a685e821f0a2f&download') . '  Manual',
            'path'         => Yii::getPathOfAlias('root.docs'),
            'placement'    => 'top',
            'checkAccess'  => !Yii::app()->user->isGuest,
            'icon'         => 'icon-tag',
            'allowext'     => array(
                'md'
            )
        )
    );
