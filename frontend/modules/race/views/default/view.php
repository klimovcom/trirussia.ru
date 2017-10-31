<?php
use \willGo\models\WillGo;
use yii\helpers\Html;
use race\models\Race;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->registerCssFile('https://fonts.googleapis.com/css?family=Roboto:300,400,500');
$this->registerJsFile("https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places");
$quest = Yii::$app->user->isGuest ? 'data-toggle="modal" data-target="#openUser"' : '';

$price = $race->getPriceRepresentation() ? $race->getPriceRepresentation() : Html::tag('span', 'Нет цены', ['class' => 'text-muted']);
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
                <div class="card-block border-<?= $race->getSportClass();?>">
                    <div class="pull-left">
                        <h6 class="sport-caption <?= $race->getSportClass();?>">
                            <?= $race->sport->label; ?>
                            <span class="m-l-1">
                        <?php
                        for ($i = 0; $i<$race->getPopularityRate(); $i ++) {
                            echo '<i class="fa fa-circle" aria-hidden="true"></i>';
                        }
                        ?>
                            </span>
                        </h6>
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
                        <?php if ($race->organizer) { ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <p class="m-b-0"><strong><a href="<?= Url::to(['/site/search-races', 'organizer' => $race->organizer->label]);?>" class="underline"><?= $race->organizer->label; ?></a></strong></p>
                                <p class="small m-b-0">Организатор</p>
                            </div>
                        <?php } ?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <p class="m-b-0"><strong><?= Html::tag('span', $race->attendance, ['id' => 'race_attendance_counter_' . $race->id]);?></strong></p>
                            <p class="small m-b-0">Участников</p>
                        </div>
                    </div>
                    <hr>
                    <?php
                    $raceDistances = $race->raceDistanceRefs;
                    $raceDistancesRaces = ArrayHelper::getValue(ArrayHelper::index($raceDistances, null, 'type'), \race\models\RaceDistanceRef::TYPE_RACE);
                    $raceDistancesRelay = ArrayHelper::getValue(ArrayHelper::index($raceDistances, null, 'type'), \race\models\RaceDistanceRef::TYPE_RELAY);
                    $specialDistanceArray = $race->special_distance ? explode(',', $race->special_distance) : [];

                    if ((count($raceDistancesRaces) || count($specialDistanceArray)) && count($raceDistancesRelay)) {
                        $raceDistanceClass = 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6';
                        $raceDistanceItemClass = 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-b-1';
                        $raceDistanceRelayItemClass = 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 m-b-1';
                    }else {
                        $raceDistanceClass = 'col-xs-12';
                        $raceDistanceItemClass = 'col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 m-b-1';
                        $raceDistanceRelayItemClass = 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-b-1';
                    }

                    echo Html::beginTag('div', ['class' => 'row']);

                    if (count($raceDistancesRaces) || count($specialDistanceArray)) {

                        echo Html::beginTag('div', ['class' => $raceDistanceClass]);
                        echo Html::tag('p', Html::tag('i', 'Индвивидуальные гонки'),['class' => 'PTSerif']);
                        echo Html::beginTag('div', ['class' => 'row']);

                        if (is_array($raceDistancesRaces)) {
                            foreach ($raceDistancesRaces as $raceDistance) {

                                echo Html::beginTag('div', ['class' => $raceDistanceItemClass]);
                                echo Html::tag('p', Html::tag('strong', $raceDistance->distance->label), ['class' => 'm-b-0']);
                                echo Html::tag('p', $raceDistance->price ? $raceDistance->price  . ' ' . $race->getCurrencyRepresentation() : $price, ['class' => 'small m-b-0']);
                                echo Html::beginTag('p', ['class' => 'small m-b-0']);

                                if ($race->with_registration) {
                                    $is_registered = $race->isUserRegister($raceDistance->distance_id, $raceDistance->type);
                                    switch ($race->register_status) {
                                        case Race::REGISTER_STATUS_OPEN :
                                            if ($is_registered) {
                                                echo Html::tag('span', 'Вы уже зарегистрированы');
                                            }else {
                                                if (Yii::$app->user->isGuest) {
                                                    echo Html::a('Зарегистрироваться', 'javascript:;', ['class' => 'underline', 'data-toggle' => 'modal', 'data-target' => '#openUser']);
                                                }else {
                                                    echo Html::a('Зарегистрироваться', 'javascript:;',['class' => 'underline race-register', 'data-race-id' => $race->id, 'data-distance-id' => $raceDistance->distance_id, 'data-type' => $raceDistance->type]);
                                                }
                                            }
                                            break;
                                        case Race::REGISTER_STATUS_CANCELED :
                                            echo Html::tag('span', 'Регистрация отменена');
                                            break;
                                        case Race::REGISTER_STATUS_CLOSED :
                                            echo $is_registered ? Html::tag('span', 'Вы уже зарегистрированны') : Html::tag('span', 'Регистрация окончена');
                                            break;
                                        case Race::REGISTER_STATUS_PAUSED :
                                            echo $is_registered ? Html::tag('span', 'Вы уже зарегистрированны') : Html::tag('span', 'Регистрация временно приостановлена');
                                            break;

                                    }
                                }
                                echo Html::endTag('p');
                                echo Html::endTag('div');
                            }
                        }

                        if (count($specialDistanceArray)) {
                            foreach ($specialDistanceArray as $distance) {
                                echo Html::beginTag('div', ['class' => $raceDistanceItemClass]);
                                echo Html::tag('p', Html::tag('strong', $distance), ['class' => 'm-b-0']);
                                echo Html::tag('p', $price, ['class' => 'small m-b-0']);
                                echo Html::endTag('div');
                            }
                        }
                        echo Html::endTag('div');
                        echo Html::endTag('div');
                    }

                    if (is_array($raceDistancesRelay)) {
                        echo Html::beginTag('div', ['class' => $raceDistanceClass]);
                        echo Html::tag('p', Html::tag('i', 'Эстафеты'),['class' => 'PTSerif']);
                        echo Html::beginTag('div', ['class' => 'row']);

                        foreach ($raceDistancesRelay as $raceDistance) {
                            echo Html::beginTag('div', ['class' => $raceDistanceRelayItemClass]);
                            echo Html::tag('p', Html::tag('strong', $raceDistance->distance->label), ['class' => 'm-b-0']);
                            echo Html::tag('p', $raceDistance->price ? $raceDistance->price  . ' ' . $race->getCurrencyRepresentation() : $price, ['class' => 'small m-b-0']);

                            echo Html::beginTag('p', ['class' => 'small m-t-1 m-b-0']);

                            if (Yii::$app->user->id) {
                                echo 'У меня нет команды: ' . Html::a('Хочу в эстафету', 'javascript:;', ['class' => 'dotted btn-race-relay-register', 'data-distance-id' => $raceDistance->distance->id, 'data-race-id' => $race->id]);
                            }else {
                                echo 'У меня нет команды: ' . Html::a('Хочу в эстафету', 'javascript:;', ['class' => 'dotted', 'data-toggle' => 'modal', 'data-target' => '#openUser']);
                            }
                            echo Html::endTag('p');

                            echo Html::endTag('div');
                        }

                        echo Html::endTag('div');
                        echo Html::endTag('div');
                    }
                    echo Html::endTag('div');

                    if (count($raceDistancesRaces) || count($specialDistanceArray) || count($raceDistancesRelay)) {
                        echo Html::tag('hr');
                    }
                    ?>
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
                    <?php if ($race->raceRegulations || $race->raceTraces):?>
                        <div class="row fancybox_container">
                            <h6 class="partner-caption m-y-3 text-xs-center">Документы</h6>
                            <?php
                            $counter = 1;
                            foreach ($race->raceRegulations as $document) {
                                echo $this->render('_race_document', [
                                    'model' => $document,
                                    'counter' => $counter,
                                ]);
                                $counter++;
                            }
                            $counter = 1;
                            foreach ($race->raceTraces as $document) {
                                echo $this->render('_race_document', [
                                    'model' => $document,
                                    'counter' => $counter,
                                ]);
                                $counter++;
                            }
                            ?>
                        </div>
                    <?php endif;?>

                    <div class="register">
                        <?php if (!$race->with_registration):?>
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
                        <?php endif;?>
                        <p><i class="fa fa-exclamation-circle fa-lg" style="margin-right: 8px;" aria-hidden="true"></i><strong>Страховка для соревнований обязательна</strong></p>
                        <p>Для участия в соревнованиях на территории России необходимо иметь страховку от несчастного случая. Для международных стартов — международную медицинскую страховку. Все страховки электронные, принимаются организаторами.</p>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <p class="small">Для соревнований в России:</p>
                                <a href="https://prosto.insure/sportivnaja-strakhovka/?utm_source=trirussia&utm_medium=teaser&utm_campaign=race_insurance" class="btn btn-primary-outline" target="_blank">Купить в онлайне от 30 ₽</a>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <p class="small">Для соревнований за границей:</p>
                                <a href="https://prosto.insure/turisticheskaja-strakhovka/?utm_source=trirussia&utm_medium=teaser&utm_campaign=race_insurance" class="btn btn-primary-outline" target="_blank">Купить в онлайне от 100 ₽</a>
                            </div>
                        </div>
                        <p class="m-t-2 m-b-0"><img src="https://prosto.insure/img/brand.svg" style="height: 13px; margin-top: -3px;"> — спортивные страховки в онлайне.</p>
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
<div class="modal fade" id="race-relay-register-modal" tabindex="-1" role="dialog" aria-labelledby="relay-register-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>

                <h4 class="modal-title" id="relay-register-label">Выберите свою команду</h4>
            </div>
            <div class="modal-body">

                <p>Указано количество свободных мест в эстафете по каждому этапу. Выберите тот этап, который вы готовы взять на себя. Если вы хотите взять несколько этапов, то сначала возьмите первый, а затем —&nbsp;второй.</p>
                <p>После того, как вы выберете этап, вашим партнёрам по эстафете придёт письмо с вашими контактами, а вам —&nbsp;с их. Так вы сможете скооперироваться и купить слот на эстафету.</p>

                <div id="race-relay-register-modal-content" class="register">

                </div>

                <p class="m-t-2">После того, как вы выберете этап, ваши будущие партнёры по команде будут оповещены, чтобы вы могли скоординировать свои действия. Если вы готовы участвовать сразу в двух этапах (да, бывает и такое), то вам необходимо пройти эту процедуру два раза.</p>

            </div>
        </div>
    </div>
</div>