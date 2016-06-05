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

$this->registerCssFile('/css/bootstrap.min.css');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
$this->registerCssFile('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
$this->registerCssFile('/plugins/select2/select2.min.css');
$this->registerCssFile('/plugins/timepicker/bootstrap-timepicker.min.css');
$this->registerCssFile('/plugins/datatables/dataTables.bootstrap.css');
$this->registerCssFile('/css/AdminLTE.min.css');
$this->registerCssFile('/css/skins/skin-blue.min.css');
$this->registerCssFile('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
$this->registerCssFile('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
$this->registerCssFile('/css/site.css');




?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <html>

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="#" class="logo">
                <span class="logo-mini"><b>Tri</b></span>
                <span class="logo-lg"><b>TriRussia.ru</b></span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Скрыть</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/images/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs">Artem Klimov</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="header">Главное меню</li>
                    <li><a href="<?= Url::to('/user/user/index'); ?>"><span>Пользователи</span></a></li>
                    <li><a href="<?= Url::to('/race/race/index'); ?>"><span>Соревнования</span></a></li>
                    <li><a href="<?= Url::to('/sport/sport/index'); ?>"><span>Виды спорта</span></a></li>
                    <li class="treeview <?= $this->context->module->id == 'distance' ? 'active' : '';?>">
                        <a href="#"><span>Дистанции</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?= Url::to('/distance/distance/index'); ?>">Дистанции</a></li>
                            <li><a href="<?= Url::to('/distance/distance-category/index'); ?>">Категории</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= Url::to('/organizer/organizer/index'); ?>"><span>Организаторы</span></a></li>
                    <li><a href="<?= Url::to('/coach/coach/index'); ?>"><span>Тренеры</span></a></li>
                    <li><a href="<?= Url::to('/page/page/index'); ?>"><span>Страницы</span></a></li>
                    <li><a href="<?= Url::to('/post/post/index'); ?>"><span>Журнал</span></a></li>
                    <li><a href="<?= Url::to('/product/product/index'); ?>"><span>Магазин</span></a></li>
                    <li><a href="<?= Url::to('/promo/promo/index'); ?>"><span>Промо-блоки</span></a></li>
                    <li><a href="<?= Url::to('/banner/banner/index'); ?>"><span>Баннеры</span></a></li>
                    <li><a href="<?= Url::to('/configuration/configuration/index'); ?>"><span>Конфигурация</span></a></li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">

        <?= $content; ?>

        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                Удачных стартов!
            </div>
            <strong>Copyright &copy; <?=date('Y');?> <a target="_blank" href="http://www.trirussia.ru">TriRussia.ru</a>.</strong>
        </footer>
    </div>
    <script type="application/javascript" src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage();