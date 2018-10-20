<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

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
        'css/site.css',
        'css/style.css',
       // 'bower_components/bootstrap/dist/css/bootstrap.min.css',
       // 'bower_components/font-awesome/css/font-awesome.min.css',
       // 'bower_components/Ionicons/css/ionicons.min.css',
       // 'dist/css/AdminLTE.min.css',
       // 'dist/css/skins/skin-blue.min.css'

    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',

    ];
}
