<?php

    /**
     * Class File
     * @author      Christopher Stebe <cstebe@iserv4u.com>
     * @link        https://github.com/Quexer69/yii-manual-widget
     * @copyright   Copyright &copy; 2013 iServ4u GbR
     * @link        ManualController
     * @package     quexer69/yii-manual-widget
     * @version     1.0.0
     *
     * @description TBD
     *
     * <pre>
     * <?php
     *   $this->widget('application.components.manual-widget.ManualWidget', array(
                'manualHeader' => 'My Manual',
                'path'         => Yii::getPathOfAlias('root.docs'),
                'placement'    => 'top',
                'checkAccess'  => !Yii::app()->user->isGuest,
                'icon'         => 'icon-tag',
                'allowext'     => array(
                    'md'
                )
            )
        );
     *
     * </pre>
     */
    class ManualWidget extends CWidget
    {

        /**
         * @var string manualName
         */
        public $manualHeader;

        /**
         * @var string path
         */
        public $path;

        /**
         * @var string path
         */
        public $allowext = array("md");

        /**
         * @var string placement
         */
        public $placement = "top";

        /**
         * @var string news types
         */
        public $checkAccess = true;

        /**
         * @var string icon class name
         */
        public $icon;

        public function init()
        {
            parent::init();
        }

        public function run()
        {
            echo '<div class="row-fluid">
                    <div class="span12">
                        <div class="muted"><strong>' . (($this->manualHeader) ? $this->manualHeader : false) . '</strong></div>
                    </div>
                </div>';

            echo "<hr>";

            if (!is_dir($this->path)) {
                throw new CException(401);
            } else {
                $this->renderManualTabs(self::scanDirectories($this->path, $this->allowext));
            }
        }

        /**
         * @description render tap-clips from $files_array and generate array to merge in TbTabs widget
         *
         * @param $files_array
         *
         * @return array with TbTab markup
         */
        public function renderManualTabs($files_array)
        {
            $tabs    = array();
            $counter = 0;
            foreach ($files_array AS $filename => $path) {

                Yii::app()->controller->beginClip($filename);
                echo '
                <div class="row-fluid">
                    <div class="span12">';
                Yii::app()->controller->beginWidget('CMarkdown');
                if (is_file($path)) {
                    echo file_get_contents($path);
                }
                Yii::app()->controller->endWidget();
                echo '
                    </div>
                </div>';
                Yii::app()->controller->endClip();

                $length   = strlen($filename);
                $last_dot = strrpos(substr($filename, 0, $length), '.');
                $label    = substr($filename, 0, $last_dot);

                $tabs[] =
                    array(
                        'id'      => 'manual_' . $label,
                        'label'   => '' . strtoupper($label) . '',
                        'icon'    => ($this->icon) ? $this->icon : false,
                        'content' => Yii::app()->controller->clips[$filename],
                        'visible' => $this->checkAccess,
                        'active'  => ($counter == 0) ? true : false,
                    );
                $counter++;
            }

            /**
             * Output TbTabs widgets
             */
            Yii::app()->controller->widget('bootstrap.widgets.TbTabs', array(
                    'type'      => 'tabs',
                    'placement' => $this->placement, // 'above', 'right', 'below' or 'left'
                    'tabs'      => $tabs

                )
            );
        }

        /**
         * @description Scan a directory for specific file extensions
         *
         * @param       $rootDir
         * @param       $allowext
         * @param array $allData
         *
         * @return array
         */
        static public function scanDirectories($rootDir, $allowext, $allData = array())
        {
            $dirContent = scandir($rootDir);
            foreach ($dirContent as $key => $content) {
                $path = $rootDir . '/' . $content;
                $ext  = substr($content, strrpos($content, '.') + 1);

                if (in_array($ext, $allowext)) {
                    if (is_file($path) && is_readable($path)) {
                        $allData[$content] = $path;
                    } elseif (is_dir($path) && is_readable($path)) {

                        // recursive callback to open new directory
                        $allData = self::scanDirectories($path, $allData);
                    }
                }
            }
            return $allData;
        }
    }