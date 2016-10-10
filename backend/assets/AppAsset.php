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

        '/plugins/tag-it/css/jquery.tagit.css',
        '/plugins/tag-it/css/tagit.ui-zendesk.css',
        '/plugins/tag-it/_static/master.css',
        '/plugins/tag-it/_static/examples.css',
        '/plugins/tag-it/_static/subpage.css',
    ];
    public $js = [
        /*'/plugins/jQuery/jQuery-2.1.4.min.js',*/
        '/js/jquery-ui.min.js',
        '/js/bootstrap.min.js',
        '/plugins/datatables/jquery.dataTables.min.js',
        '/plugins/datatables/dataTables.bootstrap.min.js',
        '/js/app.min.js',
        '/plugins/select2/select2.full.min.js',
        '/plugins/timepicker/bootstrap-timepicker.min.js',
        '/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        '/plugins/tag-it/js/tag-it.js',
        '/js/site.js',
    ];
    public $jsOptions = [
        'position' => View::POS_END];
    public $depends = [
        /*'yii\web\YiiAsset',*/
        /*'yii\bootstrap\BootstrapAsset',*/
    ];
}
