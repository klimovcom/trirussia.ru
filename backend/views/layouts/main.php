<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 22.02.16
 * Time: 10:38
 */

use yii\helpers\Html;
use \yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

\backend\assets\AppAsset::register($this);

$this->registerJsFile('/js/jquery-1.11.3.min.js');
$this->registerJsFile('/js/jQuery-2.1.4.min.js');
$this->registerJsFile('/js/jquery-ui.min.js');
$this->registerJs('$(document).ready(function(){
 $(".myTags").tagit();
});');
$this->registerJs('$.widget.bridge(\'uibutton\', $.ui.button);');
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Company</b>Name</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?= Yii::$app->user->isGuest ? 'Гость' : Yii::$app->user->identity->username; ?></span>
                        </a>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <?php if (Yii::$app->user->isGuest){ ?>
                        <li>
                            <a href="<?= Url::to('/site/login');?>" class="move" data-toggle="control-sidebar">Вход</i></a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?= Url::to('/site/logout');?>" class="move" data-toggle="control-sidebar">Выход</i></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?= Yii::$app->user->isGuest ? 'Гость' : Yii::$app->user->identity->username; ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">Главное меню</li>
                <li>
                    <a href="<?= Url::to('/race/race/index'); ?>">
                        <i class="fa fa-newspaper-o"></i> <span>Соревнования</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to('/sport/sport/index'); ?>">
                        <i class="fa fa-comment"></i> <span>Виды спорта</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to('/user/user/index'); ?>">
                        <i class="fa fa-user"></i> <span>Пользователи</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?= Url::to('/gallery/gallery/index'); ?>">
                        <i class="fa fa-book"></i> <span>Дистанции</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= Url::to('/distance/distance/index'); ?>"><i class="fa fa-book"></i>Дистанции</a></li>
                        <li><a href="<?= Url::to('/distance/distance-category/index'); ?>"><i class="fa fa-clone"></i>Категории дистанций</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?= Url::to('/organizer/organizer/index'); ?>">
                        <i class="fa fa-envelope-o"></i> <span>Организаторы</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to('/coach/coach/index'); ?>">
                        <i class="fa fa-list-alt"></i> <span>Тренеры</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to('/post/post/index'); ?>">
                        <i class="fa fa-twitter"></i> <span>Публикации</span>
                    </a>
                </li>

                <!--<li class="treeview">
                    <a href="<?/*= Url::to('/gallery/gallery/index'); */?>">
                        <i class="fa fa-file-image-o"></i> <span>Галлереи</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?/*= Url::to('/gallery/gallery/index'); */?>"><i class="fa fa-clone"></i> Галлереи</a></li>
                        <li><a href="<?/*= Url::to('/gallery/gallery-picture/index'); */?>"><i class="fa fa-file-image-o"></i> Изображения</a></li>
                    </ul>
                </li>-->
                <li>
                    <a href="<?= Url::to('/page/page/index'); ?>">
                        <i class="fa fa-envelope"></i> <span>Страницы</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to('/product/product/index'); ?>">
                        <i class="fa fa-envelope"></i> <span>Товары</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to('/configuration/configuration/index'); ?>">
                        <i class="fa fa-cogs"></i> <span>Кофигурация</span>
                    </a>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <?php
    $breadcrumbs = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
    if ($breadcrumbs) :?>
        <div class="row wrapper border-bottom page-heading breadcrumbs-div">
            <div class="col-lg-9">
                <h2><?= end($breadcrumbs) ?></h2>
                <?= \yii\widgets\Breadcrumbs::widget(
                    [
                        'links' => $breadcrumbs,
                    ]
                ) ?>
            </div>
        </div>
    <?php endif ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <?= $content; ?>

    </div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->
<!--
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.0
    </div>
    <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
</footer>-->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();

