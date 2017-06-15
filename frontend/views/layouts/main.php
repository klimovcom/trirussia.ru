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
use yii\authclient\widgets\AuthChoice;

$quest = Yii::$app->user->isGuest ? 'data-toggle="modal" data-target="#openUser"' : '';
AppAsset::register($this);

if (Yii::$app->controller->action->id !== 'error'
    && Yii::$app->controller->action->id !== 'auth'
    && Yii::$app->controller->action->id !== 'login'
    && Yii::$app->controller->action->id !== 'request-password-reset'
    && Yii::$app->controller->action->id !== 'reset-password'
    && Yii::$app->controller->action->id !== 'signup') {
    Yii::$app->getUser()->setReturnUrl(Url::to());
}
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

    <?= $this->render('_seo-tags'); ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic|Merriweather:400,300,700&subset=latin,cyrillic,cyrillic-ext">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
    <?php $this->head() ?>

    <script type="text/javascript" src="/js/adriver.core.2.js">

	<!-- ManyChat -->
	<script src="//widget.manychat.com/582913601812625.js" async="async"></script>

</head>

<body>
<?php $this->beginBody() ?>
<a href="#0" class="cd-top">Top</a>
<div class="collapse" id="navbarMenu" aria-expanded="false" style="">
    <?= \frontend\widgets\allRaces\AllRaces::widget(['mainView' => true, ]);?>
</div>
<div class="collapse" id="navbarMenu">
	<div class="bg-inverse p-t-1">
		<div class="container">
			<h3 class="text-white">Это TriRussia.ru</h3>
			<ul class="list-unstyled">
				<li><a href="/triathlon" class="nav-link">Триатлон</a></li>
				<li><a href="/run" class="nav-link">Бег</a></li>
				<li><a href="/swim" class="nav-link">Плавание</a></li>
				<li><a href="/bike" class="nav-link">Велоспорт</a></li>
				<li><a href="/ski" class="nav-link">Лыжи</a></li>
				<li><a href="/magazine" class="nav-link">Журнал</a></li>
				<li><a href="/shop" class="nav-link">Магазин</a></li>
			</ul>
		</div>
	</div>
</div>
<nav class="nav nav-inline c-nav">
	<div class="container">
		<div class="pull-left">
			<?= \frontend\widgets\sportsMenu\SportsMenu::widget() ?>
		</div>
        <div class="pull-right hidden-sm-down">
            <ul class="list-inline m-t-1">
                <?php if (Yii::$app->user->isGuest) { ?>
                <li class="list-inline-item">
                	<button class="btn btn-primary btn-sm" id="login-button" data-toggle="modal" data-target="#openUser">Войти</button>
                </li>
                <?php } else { ?>
				<li class="list-inline-item">
                    <?php if (Yii::$app->user->identity->first_name || Yii::$app->user->identity->last_name) {
                        $username = implode(' ', [Yii::$app->user->identity->first_name, Yii::$app->user->identity->last_name]);
                    }else {
                        $username = Yii::$app->user->identity->username;
                    }
                    echo Html::a($username, ['/site/calendar'], ['class' => 'underline-white']);
                    ?>
				</li>
				<li class="list-inline-item">
                    <a class="btn btn-secondary-outline btn-sm" id="logout-button" href="<?= Url::to('/site/logout'); ?>">Выйти</a>
				</li>
                <?php } ?>
			</ul>
        </div>
        <div class="clearfix"></div>
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

                <?php
                $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['/site/auth'], 'autoRender' => false]);
                echo Html::beginTag('ul', ['class' => 'list-unstyled']);
                foreach ($authAuthChoice->getClients() as $client) {
                    $onClick = '';
                    switch ($client->name) {
                        case 'facebook' :
                            $name = 'Facebook';
                            $iconClass = 'fa-facebook-square';
                            $onClick .=  "yaCounter26019216.reachGoal('facebookSignIn');";
                            break;
                        case 'google' :
                            $name = 'Google';
                            $iconClass = 'fa-google-plus-square';
                            $onClick .=  "yaCounter26019216.reachGoal('googleSignIn');";
                            break;
                        case 'vkontakte' :
                            $name = 'VK';
                            $iconClass = 'fa-vk';
                            $onClick .=  "yaCounter26019216.reachGoal('vkSignIn');";
                            break;
                    }
                    $onClick .= 'return true;';
                    echo Html::tag('li', Html::a(
                        '<i class="fa '. $iconClass . ' fa-lg"></i>&nbsp;&nbsp;Войти через '. $name,
                        ['/site/auth', 'authclient'=> $client->name],
                        ['class' => 'btn btn-secondary btn-lg m-b-1', 'onclick' => $onClick]
                    ));
                }
                echo Html::tag('li', Html::a('Войти через email', ['/site/login'], ['class' => 'btn btn-secondary btn-lg m-b-1']));
                echo Html::endTag('ul');
                AuthChoice::end();
                ?>
            </div>
        </div>
    </div>
</div>

<?= $content; ?>

<?php // \frontend\widgets\allRaces\AllRaces::widget(['leftView' => true, ]);?>

<footer class="footer">
    <div class="container">
        <div class="row m-b-2">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <h6>Интересное</h6>
                <ul class="list-unstyled">
                    <li><a href="<?= Url::toRoute('/post/default/index'); ?>" class="underline-white">Журнал</a></li>
                    <li><a href="<?= Url::toRoute('/product/default/index'); ?>" class="underline-white">Магазин</a></li>
                    <li><a href="<?= Url::toRoute('/site/calendar'); ?>" class="underline-white" <?= $quest;?>>Мой календарь</a></li>
                </ul>
                <h6 class="m-t-2">TriRussia.ru</h6>
                <ul class="list-unstyled">
                    <li><a href="<?= Url::toRoute('/site/about'); ?>" class="underline-white">О проекте</a></li>
                    <li><a href="<?= Url::toRoute('/site/advertising'); ?>" class="underline-white">Реклама</a></li>
                    <li><a href="<?= Url::toRoute('/site/domains'); ?>" class="underline-white">Домены</a></li>
                    <li><a href="<?= Url::toRoute('/site/wanted'); ?>" class="underline-white">Работа</a></li>
                    <li><a href="<?= Url::toRoute('/site/investor'); ?>" class="underline-white">Инвесторам</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <h6>Соревнования</h6>
                <ul class="list-unstyled">
                    <li><a href="/race/add" class="underline-white">Добавить соревнование</a></li>
			<!--<li><a href="<?= Url::to('/'); ?>" class="underline-white">Все соревнования</a></li> -->
                    <li><a href="<?= Url::to('/' . 'triathlon'/*, 'sport' => 'triathlon'*/); ?>" class="underline-white">Триатлон</a></li>
                    <li><a href="<?= Url::to('/' . 'run'/*, 'sport' => 'run'*/); ?>" class="underline-white">Бег</a></li>
                    <li><a href="<?= Url::to('/' . 'swim'/*, sport' => 'swim'*/); ?>" class="underline-white">Плавание</a></li>
                    <li><a href="<?= Url::to('/' . 'bike'/*, 'sport' => 'bike'*/); ?>" class="underline-white">Велоспорт</a></li>
                    <li><a href="<?= Url::to('/' . 'ski'/*, 'sport' => 'ski'*/); ?>" class="underline-white">Лыжи</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <h6>Справочник</h6>
                <ul class="list-unstyled">
                    <li><a href="/training" class="underline-white">Тренеры</a></li>
                    <li><a href="/organizer" class="underline-white">Организаторы</a></li>
                    <li><a href="<?= Url::toRoute('/site/bmi'); ?>" class="underline-white">Калькулятор BMI</a></li>
                    <li><a href="<?= Url::toRoute('/site/convert'); ?>" class="underline-white">Калькулятор темпа</a></li>
                    <li><a href="/promocodes" class="underline-white">Скидки в магазинах</a></li>
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
				<p class="small m-t-1">Никакого спама. Не чаще одного раза в две недели. Бонусом для тех, кто ещё не ездил на Uber: промокод на 300 рублей.</p>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.1.0/masonry.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/locales/bootstrap-datepicker.ru.min.js"></script>
<script src="/js/likely.js"></script>
<script>
	$(function() {
		$(".c-card").matchHeight();
	});

    $(document).ready(function(){
        $(".card", this).hover(function(){
            $(".card-img-caption", this).slideToggle();
        });

        $(".next-page-button", this).on("click", function(){
            $(this).parents(".card").find(".card-back").fadeToggle();
        });
    });
</script>


    <!-- Yandex.Metrika counter -->
<script src="https://mc.yandex.ru/metrika/watch.js" type="text/javascript"></script>
<script type="text/javascript">
try {
	var yaCounter26019216 = new Ya.Metrika({
		id:26019216,
		clickmap:true,
		trackLinks:true,
		accurateTrackBounce:true,
		webvisor:true
	});
} catch(e) { }
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/26019216" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- Google Analytics -->
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-16018298-20', 'auto');
	ga('send', 'pageview');
</script>
<!-- /Google Analytics -->

<!-- Rating@Mail.ru counter -->
<script type="text/javascript">
	var _tmr = _tmr || [];
	_tmr.push({id: "2662254", type: "pageView", start: (new Date()).getTime()});
	(function (d, w, id) {
		if (d.getElementById(id)) return;
		var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
		ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
		var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
		if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
	})(document, window, "topmailru-code");
</script>
<noscript><div style="position:absolute;left:-10000px;">
<img src="//top-fwz1.mail.ru/counter?id=2662254;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" />
</div></noscript>
<!-- //Rating@Mail.ru counter -->

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '693407817484704', {
em: 'insert_email_variable,'
});
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=693407817484704&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
