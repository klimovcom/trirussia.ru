<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use \yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='yandex-verification' content='5c6a73e6a139de67' />
    <meta name="author" content="TriRussia.ru">
    <meta name="keywords" content="Триатлон, бег, велоспорт, плавание, Ironman, Half-Ironman, полуайронмен, марафон, полумарафон, олимпийская дистанция, спринт, суперспринт, 5 км, 10 км, календарь соревнований">
    <meta name="description" content="Вся информация о соревнованиях по триатлону, бегу, велоспорту, плаванию, дуатлону и лыжам. Старты в России, в Москве, гонки серии Ironman, Ironstar, Титан, Гром, олимпийские дистанции и спринты">
    <meta property="og:image" content="http://www.trirussia.ru/img/logo_black.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <title>TriRussia.ru — Календарь соревнований по триатлону, бегу, велоспорту и плаванию</title>

    <title><?= Html::encode($this->title) ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic|Merriweather:400,300,700&subset=latin,cyrillic,cyrillic-ext">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
    <link rel="stylesheet" href="/css/select2-bootstrap.css">
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/likely.css">
    <link rel="stylesheet" href="/css/jquery.fancybox.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/site.css">

    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<nav class="navbar navbar-full navbar-dark bg-inverse">
    <div class="container">
      <?= \frontend\widgets\sportsMenu\SportsMenu::widget() ?>
        <div class="pull-right hidden-sm-down">
            <ul class="nav navbar-nav">
                <?php if (Yii::$app->user->isGuest) { ?>
                    <li>
                        <?= \frontend\widgets\auth\Auth::widget([
                            'baseAuthUrl' => ['/site/auth']
                        ]) ?>
                    </li>
                <?php } else { ?>
                                        
                <li class="nav-item">
                    <?= Yii::$app->user->identity->first_name . ' ' . Yii::$app->user->identity->last_name?>
                    <a class="nav-link" href="<?= Url::to('/site/logout'); ?>">Выйти</a>
                </li>

                <?php } ?>
                
            </ul>
        </div>
        <ul class="nav navbar-nav hidden-md-up">
            <li class="nav-item">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                    &#9776;
                </button>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-logo" href="/">TriRussia.ru</a>
            </li>
        </ul>
    </div>
</nav>
<div class="modal fade" id="openUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>

                <h4 class="modal-title" id="myModalLabel">Войдите на сайт</h4>
            </div>
            <div class="modal-body">
                <p>Для того, чтобы в полной мере использовать функционал сервиса, вам необходимо зарегистрироваться. Для этого просто кликните по кнопке ниже:</p>
            </div>
        </div>
    </div>
</div>


<?= $content; ?>


<div id="leftside-menu">
    <h2>Найдите соревнование</h2>
    <p>Мы собрали все лучшие соревнования и рассортировали их так, чтобы вам было удобно.</p>
    <h5 class="white">По месяцам</h5>
    <ul class="list-unstyled">
        <li><small>В 2016 году</small></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Апрель</a><span class="race-count"><small>11</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Май</a><span class="race-count"><small>13</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Июнь</a><span class="race-count"><small>51</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Июль</a><span class="race-count"><small>10</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Август</a><span class="race-count"><small>2</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Сентябрь</a><span class="race-count"><small>3</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Октябрь</a><span class="race-count"><small>40</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Ноябрь</a><span class="race-count"><small>11</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Декабрь</a><span class="race-count"><small>19</small></span></li>
        <li class="m-t-1"><small>В 2017 году</small></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Январь</a><span class="race-count"><small>1</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Февраль</a><span class="race-count"><small>0</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Март</a><span class="race-count"><small>10</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Апрель</a><span class="race-count"><small>1</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Май</a><span class="race-count"><small>0</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Июнь</a><span class="race-count"><small>10</small></span></li>

    </ul>
    <h5 class="white">По виду спорта</h5>
    <ul class="list-unstyled">
        <li class="leftbar-small"><a href="#" class="underline-white">Триатлон</a><span class="race-count"><small>12</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Бег</a><span class="race-count"><small>12</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Плавание</a><span class="race-count"><small>12</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Велоспорт</a><span class="race-count"><small>2</small></span></li>
    </ul>
    <h5 class="white">По дистанции</h5>
    <ul class="list-unstyled">
        <li><small>Триатлон</small></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Спринт</a><span class="race-count"><small>11</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Олимпийская дистанция</a><span class="race-count"><small>21</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Half-Ironman</a><span class="race-count"><small>33</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Ironman</a><span class="race-count"><small>0</small></span></li>
        <li class="m-t-1"><small>Бег</small></li>
        <li class="leftbar-small"><a href="#" class="underline-white">5 км</a><span class="race-count"><small>11</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">10 км</a><span class="race-count"><small>21</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Полумарафон</a><span class="race-count"><small>33</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Марафон</a><span class="race-count"><small>0</small></span></li>
    </ul>
    <h5 class="white">По странам</h5>
    <ul class="list-unstyled">
        <li class="leftbar-small"><a href="#" class="underline-white">Россия</a><span class="race-count"><small>12</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Германия</a><span class="race-count"><small>10</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Беларусь</a><span class="race-count"><small>9</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Швейцария</a><span class="race-count"><small>8</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Италия</a><span class="race-count"><small>7</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Люксембург</a><span class="race-count"><small>1</small></span></li>
    </ul>
    <h5 class="white">По организаторам</h5>
    <ul class="list-unstyled">
        <li class="leftbar-small"><a href="#" class="underline-white">Ironstar</a><span class="race-count"><small>12</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Ironman</a><span class="race-count"><small>10</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">A1 Triathlon</a><span class="race-count"><small>9</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Titan</a><span class="race-count"><small>8</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">New Runners</a><span class="race-count"><small>7</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">3Sport</a><span class="race-count"><small>1</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Выборгмен</a><span class="race-count"><small>8</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Challenge</a><span class="race-count"><small>8</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">Шри Чин Мой</a><span class="race-count"><small>8</small></span></li>
        <li class="leftbar-small"><a href="#" class="underline-white">МБК</a><span class="race-count"><small>8</small></span></li>
    </ul>
</div>
<footer class="footer">
    <div class="container">
        <div class="row m-b-2">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <h6>TriRussia.ru</h6>
                <ul class="list-unstyled">
                    <li><a href="/magazine" class="underline-white">Журнал</a></li>
                    <li><a href="/about.php" class="underline-white">О проекте</a></li>
                    <li><a href="/adv.php" class="underline-white">Реклама</a></li>
                    <!--                     <li><a href="#" class="underline-white">Логотипы</a></li> -->
                    <li><a href="/calend.php" class="underline-white">Мой календарь</a></li>
                    <li><a href="/domain.php" class="underline-white">Домены</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <h6>Соревнования</h6>
                <ul class="list-unstyled">
                    <li><a href="/add.php" class="underline-white">Добавить соревнование</a></li>
                    <li><a href="/all.php" class="underline-white">Все соревнования</a></li>
                    <li><a href="/races.php" class="underline-white">Триатлон</a></li>
                    <li><a href="/races.php" class="underline-white">Бег</a></li>
                    <li><a href="/races.php" class="underline-white">Плавание</a></li>
                    <li><a href="/races.php" class="underline-white">Велоспорт</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <h6>Справочник</h6>
                <ul class="list-unstyled">
                    <li><a href="/training.php" class="underline-white">Тренеры</a></li>
                    <li><a href="/org.php" class="underline-white">Организаторы</a></li>
                    <li><a href="/bmi.php" class="underline-white">Калькулятор BMI</a></li>
                    <li><a href="/convert.php" class="underline-white">Калькулятор темпа</a></li>
                    <li><a href="/shop.php" class="underline-white">Скидки</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <h6>Подпишитесь на рассылку</h6>
                <form class="form-inline m-t-1" action="//trirussia.us4.list-manage.com/subscribe/post?u=4732804bad337fc1dc84138d5&amp;id=4a7ae4d6e6" method="post" target="_blank" novalidate="">
                    <div class="row">
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xl-9">
                            <input type="email" name="EMAIL" id="mce-EMAIL" class="form-control" placeholder="Ваш email" required="">
                        </div>
                        <div style="position: absolute; left: -5000px;"><input type="text" name="b_4732804bad337fc1dc84138d5_4a7ae4d6e6" tabindex="-1" value=""></div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane fa-lg"></i></button>
                        </div>
                    </div>
                </form>
                <p class="small m-t-1">Никакого спама. Не чаще одного раза в две недели. Бонусом для тех, кто ещё не ездил на Uber: промокод на 400 рублей.</p>
            </div>
        </div>
        <p class="text-xs-center m-t-3">Сделано c <i class="fa fa-heart fa-lg text-danger"></i> триатлетами для триатлетов. В перерывах между  <i class="fa fa-bicycle fa-lg"></i></p>
        <div class="text-xs-center">
            <ul class="list-inline">
                <li class="list-inline-item"><a href="http://klimov.com" target="_blank" class="underline-white">Артём Климов</a></li>
                <li class="list-inline-item">&#8226;</li>
                <li class="list-inline-item"><a href="https://prosto.insure" target="_blank" class="underline-white">Prosto.Insure</a> <span class="text-muted hidden-sm-down">(онлайн-сервис сравнения страховок)</span></li>
            </ul>
        </div>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="/js/tether.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.1.0/masonry.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/locales/bootstrap-datepicker.ru.min.js"></script>
<script src="/js/likely.js"></script>
<script src="/js/jquery.smooth-scroll.js"></script>
<script src="/js/jquery.fancybox.pack.js"></script>
<script src="/js/theia-sticky-sidebar.js"></script>
<script src="/js/scotchPanels.min.js"></script>
<script src="/js/leftside-top-menu.js"></script>
<script src="/js/modalfix.js"></script>
<script src="/js/ad-sidebar.js"></script>
<script src="/js/site.js"></script>
<script>
    $(document).ready(function(){
        $(".card", this).hover(function(){
            $(".card-img-caption", this).slideToggle();
        });

        $(".next-page-button", this).on("click", function(){
            $(this).parents(".card").find(".card-back").fadeToggle();
        });
    });
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
