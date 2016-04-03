<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/bootstrap.min.css',
        '/css/bootstrap.css.map',
        '/css/font-awesome.min.css',
        '/css/AdminLTE.min.css',
        '/css/_all-skins.min.css',
        '/css/site.css',
    ];
    public $js = [
        '/js/bootstrap.min.js',
        '/js/app.js',
        '/js/tagit.min.js',
        '/js/site.js',

    ];
    public $jsOptions = [
        'position' => View::POS_END
    ];
    public $depends = [
        /*'yii\web\YiiAsset',*/
        /*'yii\bootstrap\BootstrapAsset',*/
    ];
}
