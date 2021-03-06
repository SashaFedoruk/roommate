<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/profileStyle.css',
        'css/radioButtonCustomize.css',
        'css/style.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.min.js',
        #'js/scrollspy.js'
        #'js/npm.js'
    ];
    public $depends = [
       #'yii\web\YiiAsset',
       #'yii\bootstrap\BootstrapAsset',
    ];
}
