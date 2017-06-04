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
                    <?php if (!Yii::$app->user->isGuest):?>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!--<img src="/images/user2-160x160.jpg" class="user-image" alt="User Image">-->
                                <span class="hidden-xs"><?= Yii::$app->user->identity->username;?></span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" data-toggle="dropdown"><i class="fa fa-gears"></i></a>
                            <ul class="dropdown-menu">
                                <li><?= Html::a('Выйти', ['/site/logout']);?></li>
                            </ul>
                        </li>
                    <?php endif;?>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu">
                <li class="header">Главное меню</li>
                <?php if (Yii::$app->user->can('user')):?>
                    <li class="treeview <?= $this->context->module->id == 'user' ? 'active' : '';?>">
                        <a href="#"><span>Пользователи</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <?= Html::tag('li', Html::a('Пользователи', ['/user/user/index']));?>

                            <?= Yii::$app->user->can('permit') ? Html::tag('li', Html::a('Роли', ['/permit/access/role']))  : '';?>
                            <?= Yii::$app->user->can('permit') ? Html::tag('li', Html::a('Правила', ['/permit/access/permission']))  : '';?>
                        </ul>
                    </li>
                <?php endif;?>
                <?= Yii::$app->user->can('race') ? Html::tag('li', Html::a('Соревнования', ['/race/race/index']))  : '';?>
                <?= Yii::$app->user->can('sport') ? Html::tag('li', Html::a('Виды спорта', ['/sport/sport/index']))  : '';?>

                <?php if (Yii::$app->user->can('distance')):?>
                    <li class="treeview <?= $this->context->module->id == 'distance' ? 'active' : '';?>">
                        <a href="#"><span>Дистанции</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?= Url::to('/distance/distance/index'); ?>">Дистанции</a></li>
                            <li><a href="<?= Url::to('/distance/distance-category/index'); ?>">Категории</a></li>
                        </ul>
                    </li>
                <?php endif;?>

                <?= Yii::$app->user->can('organizer') ? Html::tag('li', Html::a('Организаторы', ['/organizer/organizer/index']))  : '';?>
                <?= Yii::$app->user->can('coach') ? Html::tag('li', Html::a('Тренеры', ['/coach/coach/index']))  : '';?>
                <?= Yii::$app->user->can('page') ? Html::tag('li', Html::a('Страницы', ['/page/page/index']))  : '';?>
                <?= Yii::$app->user->can('post') ? Html::tag('li', Html::a('Журнал', ['/post/post/index']))  : '';?>

                <?php if (Yii::$app->user->can('product')):?>
                    <li class="treeview <?= $this->context->module->id == 'product' ? 'active' : '';?>">
                        <a href="#"><span>Магазин</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?= Url::to('/product/product/index'); ?>"><span>Продукты</span></a></li>
                            <li><a href="<?= Url::to('/product/product-category/index'); ?>"><span>Категории</span></a></li>
                            <li><a href="<?= Url::to('/product/product-attr/index'); ?>"><span>Атрибуты</span></a></li>
                            <li><a href="<?= Url::to('/product/product-order/index'); ?>"><span>Заказы</span></a></li>
                            <li><a href="<?= Url::to('/product/product-banner/index'); ?>"><span>Баннеры</span></a></li>
                        </ul>
                    </li>
                <?php endif;?>

                <?= Yii::$app->user->can('promo') ? Html::tag('li', Html::a('Промо-блоки', ['/promo/promo/index']))  : '';?>
                <?= Yii::$app->user->can('configuration') ? Html::tag('li', Html::a('Конфигурация', ['/configuration/configuration/index']))  : '';?>
                <?= Yii::$app->user->can('promocode') ? Html::tag('li', Html::a('Промокоды', ['/promocode/promocode/index']))  : '';?>
                <?= Yii::$app->user->can('camp') ? Html::tag('li', Html::a('Кэмпы', ['/camp/camp/index']))  : '';?>

            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <?php foreach (Yii::$app->session->getAllFlashes() as $key=>$value){ ?>
            <div class="flash <?= $key; ?>">
                <label><?= array_pop($value); ?></label>
            </div>
        <?php } ?>

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