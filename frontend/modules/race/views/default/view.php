<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 5/19/16
 * Time: 7:06 PM
 * @var $race \race\models\Race
 */
use \willGo\models\WillGo;
use yii\helpers\Html;
$this->registerCssFile('https://fonts.googleapis.com/css?family=Roboto:300,400,500');
$this->registerJsFile("https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places");
$quest = Yii::$app->user->isGuest ? 'data-toggle="modal" data-target="#openUser"' : '';

?>

<div class="container">
<h1 class="m-t-3"><?= $race->label ?></h1>
<h4 class="m-b-3"><?= $race->getPlaceTimePromo(); ?></h4>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
        <div class="card">
            <?php if ($race->main_image_id) { ?>
                <?= \yii\helpers\Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($race->main_image_id), [
                    'class' => 'card-img-top img-fluid',
                    'alt' => $race->label,
                ]); ?>
            <?php } ?>
            <div class="card-block border-run">
                <div class="pull-left">
                    <h6 class="sport-caption run"><?= $race->sport->label; ?></h6>
                </div>
                <div class="clearfix"></div>
                <p class="card-text PTSerif lead"><i><?= $race->promo; ?></i></p>
                <hr>
                <div class="row">
                    <?php if (!empty($race->place))  { ?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <p class="m-b-0"><strong><?= $race->place; ?></strong></p>
                            <p class="small m-b-0">Место</p>
                        </div>
                    <?php } ?>
                    <?php if (!empty($race->start_date))  { ?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <p class="m-b-0"><strong><?= $race->getDateRepresentation(); ?></strong></p>
                            <p class="small m-b-0">Дата</p>
                        </div>
                    <?php } ?>
                    <?php if ($distances = $race->getDistancesRepresentation()) { ?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <p class="m-b-0"><strong><?= $distances; ?></strong></p>
                            <p class="small m-b-0">Дистанция</p>
                        </div>
                    <?php } ?>
                </div>
                <hr>
                <div class="row">
                    <?php if ($race->organizer) { ?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <p class="m-b-0"><strong><?= $race->organizer->label; ?></strong></p>
                            <p class="small m-b-0">Организатор</p>
                        </div>
                    <?php } ?>
                    <?php if ($race->price) { ?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <p class="m-b-0"><strong><?= $race->getPriceRepresentation(); ?></strong></p>
                            <p class="small m-b-0">Цена</p>
                        </div>
                    <?php } ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <p class="m-b-0"><strong><?= Html::tag('span', $race->attendance, ['id' => 'race_attendance_counter_' . $race->id]);?></strong></p>
                        <p class="small m-b-0">Участников</p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                        <p class="m-b-0">
                            <?= $race->getPopularityRepresentation('/img/rating_black.png');?>
                        </p>
                        <p class="small m-b-0">Популярность</p>
                    </div>
                </div>
                <hr>
                <div class="pull-left hidden-sm-down">
                    <div class="likely">
                        <div class="facebook">Поделиться</div>
                        <div class="twitter">Твитнуть</div>
                        <div class="vkontakte">Поделиться</div>
                    </div>
                </div>


                <?php if (!Yii::$app->user->isGuest) { ?>
                    <div class="pull-right hidden-sm-down i-will-go">
                        <?php if (WillGo::isTakingPart($race->id)) { ?>
                            <span class="PTSerif">
                                <i class="already-joined" data-id="<?= $race->id; ?>" data-url="<?= WillGo::dismissUrl(); ?>">
                                    <i class="fa fa-star gold" aria-hidden="true"></i>&nbsp;&nbsp;Вы участвуете
                                </i>
                            </span>
                            <button class="btn btn-secondary btn-sm hidden will-join" data-id="<?= $race->id; ?>" data-url="<?= WillGo::joinUrl(); ?>">
                                Я тоже участвую
                            </button>
                        <?php } else { ?>
                            <span class="PTSerif">
                                <i class="already-joined hidden" data-id="<?= $race->id; ?>" data-url="<?= WillGo::dismissUrl(); ?>">
                                    <i class="fa fa-star gold" aria-hidden="true"></i>&nbsp;&nbsp;Вы участвуете
                                </i>
                            </span>
                            <button class="btn btn-secondary btn-sm will-join" data-id="<?= $race->id; ?>" data-url="<?= WillGo::joinUrl(); ?>">
                                Я тоже участвую
                            </button>
                        <?php } ?>
                    </div>
                <?php } else {?>
                    <div class="pull-right hidden-sm-down">
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#openUser">
                            Я тоже участвую
                        </button>
                    </div>
                <?php } ?>

                
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-block">
                <h2>Описание</h2>
                <div class="fancybox_container">
                    <?= $race->content; ?>
                </div>
                <div class="register">
                    <h5 class="PTSerif m-b-2"><i>Регистрация на <?= $race->label;?></i></h5>
                    <button type="button" class="btn btn-secondary" id="register" <?= $quest; ?> onclick="yaCounter26019216.reachGoal('register'); return true;">Зарегистрироваться</button>
                    <div id="register-question">
                        <p>Вам было бы удобно в будущем регистрироваться на соревнование здесь же без перехода на сайт организатора?</p>
                        <button type="button" class="btn btn-secondary register-button" id="register-yes" onclick="yaCounter26019216.reachGoal('registerYes'); return true;">Да</button>
                        <button type="button" class="btn btn-secondary register-button" id="register-no" onclick="yaCounter26019216.reachGoal('registerNo'); return true;">Нет</button>
                    </div>
                    <div id="register-link">
                        <p>Спасибо! Мы учтём ваш ответ в нашей работе.</p>
                        <a href="<?= $race->site; ?>" type="button" class="btn btn-secondary" target="_blank">Перейти на сайт</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sidebar">
        <div class="theiaStickySidebar">
            <div class="ad-sidebar text-xs-center">
				<!--  AdRiver code START. Type:300x250 Site: trirussia PZ: 0 BN: 1 -->
				<script type="text/javascript">
				var RndNum4NoCash = Math.round(Math.random() * 1000000000);
				var ar_Tail='unknown'; if (document.referrer) ar_Tail = escape(document.referrer);
				document.write(
				'<iframe src="' + ('https:' == document.location.protocol ? 'https:' : 'http:') + '//ad.adriver.ru/cgi-bin/erle.cgi?'
				+ 'sid=201788&bn=1&target=blank&w=300&h=600&bt=40&pz=0&rnd=' + RndNum4NoCash + '&tail256=' + ar_Tail
				+ '" frameborder=0 vspace=0 hspace=0 width=300 height=600 marginwidth=0'
				+ ' marginheight=0 scrolling=no></iframe>');
				</script>
				<noscript>
				<a href="//ad.adriver.ru/cgi-bin/click.cgi?sid=201788&bn=1&bt=40&pz=0&rnd=335117872" target=_blank>
				<img src="//ad.adriver.ru/cgi-bin/rle.cgi?sid=201788&bn=1&bt=40&pz=0&rnd=335117872" alt="-AdRiver-" border=0 width=300 height=600></a>
				</noscript>
				<!--  AdRiver code END  -->
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 hidden new-sidebar">
        <div class="ad-sidebar text-xs-center">
			<!--  AdRiver code START. Type:300x250 Site: trirussia PZ: 0 BN: 1 -->
			<script type="text/javascript">
			var RndNum4NoCash = Math.round(Math.random() * 1000000000);
			var ar_Tail='unknown'; if (document.referrer) ar_Tail = escape(document.referrer);
			document.write(
			'<iframe src="' + ('https:' == document.location.protocol ? 'https:' : 'http:') + '//ad.adriver.ru/cgi-bin/erle.cgi?'
			+ 'sid=201788&bn=1&target=blank&w=300&h=600&bt=40&pz=0&rnd=' + RndNum4NoCash + '&tail256=' + ar_Tail
			+ '" frameborder=0 vspace=0 hspace=0 width=300 height=600 marginwidth=0'
			+ ' marginheight=0 scrolling=no></iframe>');
			</script>
			<noscript>
			<a href="//ad.adriver.ru/cgi-bin/click.cgi?sid=201788&bn=1&bt=40&pz=0&rnd=335117872" target=_blank>
			<img src="//ad.adriver.ru/cgi-bin/rle.cgi?sid=201788&bn=1&bt=40&pz=0&rnd=335117872" alt="-AdRiver-" border=0 width=300 height=600></a>
			</noscript>
			<!--  AdRiver code END  -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
        <?php if($race->coord_lat && $race->coord_lon) { ?>
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title m-b-0"><?= $race->label; ?> на карте</h4>
                </div>
                <div id="googleMap" data-lon="<?=$race->coord_lon;?>" data-lat="<?=$race->coord_lat;?>" style="height:455px;"></div>
            </div>
        <?php } ?>
        <div class="card m-t-1">
            <?= \frontend\widgets\moreRaces\MoreRaces::widget(['model' => $race, ])?>
        </div>
        <div class="card m-t-1">
            <div class="card-block">
                <div id="disqus_thread"></div>
                <script type="text/javascript">
                    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                    var disqus_shortname = 'trirussia'; // required: replace example with your forum shortname

                    /* * * DON'T EDIT BELOW THIS LINE * * */
                    (function() {
                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sidebar">
		<?= \frontend\widgets\allRaces\AllRaces::widget([ 'sport'=>$race->sport->url, 'raceView' => true, ]); ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 hidden new-sidebar">
		<?= \frontend\widgets\allRaces\AllRaces::widget([ 'sport'=>$race->sport->url, 'raceView' => true, ]); ?>
        <div class="ad-sidebar text-xs-center">
			<a href="https://www.asics.ru/running/products/gel-kayano-men/" target="_blank"><img src="http://files.www.fleetfeetraleigh.com/news/cq5dam.thumbnail.400.400-process-s400x333.png"></a>
        </div>
    </div>
</div>
</div>
