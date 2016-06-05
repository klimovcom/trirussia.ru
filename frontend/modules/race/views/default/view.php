<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 5/19/16
 * Time: 7:06 PM
 * @var $race \race\models\Race
 */
use \willGo\models\WillGo;
$this->registerCssFile('https://fonts.googleapis.com/css?family=Roboto:300,400,500');
$this->registerJsFile("https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places");


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
                    'alt' => 'Card image cap',
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
                        <p class="m-b-0"><strong>32</strong></p>
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
                <?php } ?>

                
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-block">
                <h4><?= $race->label; ?></h4>
                <?= $race->content; ?>
                <div class="register">
                    <h5 class="PTSerif m-b-2"><i>Регистрация на Весенний гром</i></h5>
                    <button type="button" class="btn btn-secondary" id="register">Зарегистрироваться</button>
                    <div id="register-question">
                        <p>Вам было бы удобно в будущем регистрироваться на соревнование здесь же без перехода на сайт организатора?</p>
                        <button type="button" class="btn btn-secondary register-button" id="register-yes">Да</button>
                        <button type="button" class="btn btn-secondary register-button" id="register-no">Нет</button>
                    </div>
                    <div id="register-link">
                        <p>Спасибо! Мы учтём ваш ответ в нашей работе.</p>
                        <a href="#" type="button" class="btn btn-secondary" target="_blank">Перейти на сайт</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sidebar">
        <div class="theiaStickySidebar">
            <div class="ad-sidebar text-xs-center">
                <img src="https://s-media-cache-ak0.pinimg.com/736x/2d/82/a6/2d82a6a6be76603d79a263f05ee96ac8.jpg">
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 hidden new-sidebar">
        <div class="ad-sidebar text-xs-center">
            <img src="https://s-media-cache-ak0.pinimg.com/736x/2d/82/a6/2d82a6a6be76603d79a263f05ee96ac8.jpg">
        </div>
        <div class="ad-sidebar text-xs-center">
            <img src="http://lightnup.ph/wp-content/uploads/2015/02/2XU2-300x250.jpg">
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
        <div class="card card-block">
            <h4 class="card-title m-b-0">Другие соревнования</h4>
            <hr>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <h6>По месяцам</h6>
                    <ul class="list-unstyled">
                        <li><small>В 2016 году</small></li>
                        <li class="leftbar-small"><a href="races.php" class="underline">Апрель</a><span class="race-count"><small>11</small></span></li>
                        <li class="leftbar-small"><a href="races1.php" class="underline">Май</a><span class="race-count"><small>13</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Июнь</a><span class="race-count"><small>51</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Июль</a><span class="race-count"><small>10</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Август</a><span class="race-count"><small>2</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Сентябрь</a><span class="race-count"><small>3</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Октябрь</a><span class="race-count"><small>40</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Ноябрь</a><span class="race-count"><small>11</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Декабрь</a><span class="race-count"><small>19</small></span></li>
                        <li class="m-t-1"><small>В 2017 году</small></li>
                        <li class="leftbar-small"><a href="#" class="underline">Январь</a><span class="race-count"><small>1</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Февраль</a><span class="race-count"><small>0</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Март</a><span class="race-count"><small>10</small></span></li>
                    </ul>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <h6>По виду спорта</h6>
                    <ul class="list-unstyled">
                        <li class="leftbar-small"><a href="#" class="underline">Триатлон</a><span class="race-count"><small>12</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Бег</a><span class="race-count"><small>12</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Плавание</a><span class="race-count"><small>12</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Велоспорт</a><span class="race-count"><small>2</small></span></li>
                    </ul>
                    <h6>По дистанции</h6>
                    <ul class="list-unstyled">
                        <li><small>Триатлон</small></li>
                        <li class="leftbar-small"><a href="#" class="underline">Спринт</a><span class="race-count"><small>11</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Олимпийская дистанция</a><span class="race-count"><small>21</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Half-Ironman</a><span class="race-count"><small>33</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Ironman</a><span class="race-count"><small>0</small></span></li>
                        <li class="m-t-1"><small>Бег</small></li>
                        <li class="leftbar-small"><a href="#" class="underline">5 км</a><span class="race-count"><small>11</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">10 км</a><span class="race-count"><small>21</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Полумарафон</a><span class="race-count"><small>33</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Марафон</a><span class="race-count"><small>0</small></span></li>
                    </ul>
                </div>
            </div>
            <hr>
            <a href="all.php" class="underline">Все соревнования</a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 hidden new-sidebar">
        <div class="card card-block">
            <h4 class="card-title m-b-0">Другие соревнования</h4>
            <hr>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <h6>По месяцам</h6>
                    <ul class="list-unstyled">
                        <li><small>В 2016 году</small></li>
                        <li class="leftbar-small"><a href="races.php" class="underline">Апрель</a><span class="race-count"><small>11</small></span></li>
                        <li class="leftbar-small"><a href="races1.php" class="underline">Май</a><span class="race-count"><small>13</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Июнь</a><span class="race-count"><small>51</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Июль</a><span class="race-count"><small>10</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Август</a><span class="race-count"><small>2</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Сентябрь</a><span class="race-count"><small>3</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Октябрь</a><span class="race-count"><small>40</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Ноябрь</a><span class="race-count"><small>11</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Декабрь</a><span class="race-count"><small>19</small></span></li>
                        <li class="m-t-1"><small>В 2017 году</small></li>
                        <li class="leftbar-small"><a href="#" class="underline">Январь</a><span class="race-count"><small>1</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Февраль</a><span class="race-count"><small>0</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Март</a><span class="race-count"><small>10</small></span></li>
                    </ul>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <h6>По виду спорта</h6>
                    <ul class="list-unstyled">
                        <li class="leftbar-small"><a href="#" class="underline">Триатлон</a><span class="race-count"><small>12</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Бег</a><span class="race-count"><small>12</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Плавание</a><span class="race-count"><small>12</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Велоспорт</a><span class="race-count"><small>2</small></span></li>
                    </ul>
                    <h6>По дистанции</h6>
                    <ul class="list-unstyled">
                        <li><small>Триатлон</small></li>
                        <li class="leftbar-small"><a href="#" class="underline">Спринт</a><span class="race-count"><small>11</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Олимпийская дистанция</a><span class="race-count"><small>21</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Half-Ironman</a><span class="race-count"><small>33</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Ironman</a><span class="race-count"><small>0</small></span></li>
                        <li class="m-t-1"><small>Бег</small></li>
                        <li class="leftbar-small"><a href="#" class="underline">5 км</a><span class="race-count"><small>11</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">10 км</a><span class="race-count"><small>21</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Полумарафон</a><span class="race-count"><small>33</small></span></li>
                        <li class="leftbar-small"><a href="#" class="underline">Марафон</a><span class="race-count"><small>0</small></span></li>
                    </ul>
                </div>
            </div>
            <hr>
            <a href="all.php" class="underline">Все соревнования</a>
        </div>
        <div class="ad-sidebar text-xs-center">
            <img src="http://files.www.fleetfeetraleigh.com/news/cq5dam.thumbnail.400.400-process-s400x333.png">
        </div>
    </div>
</div>
</div>
