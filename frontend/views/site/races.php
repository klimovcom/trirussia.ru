<?php
use willGo\models\WillGo;
$quest = Yii::$app->user->isGuest ? 'data-toggle="modal" data-target="#openUser"' : '';
/**
 * @var $races []
 * @var $showMore bool
 */
?>
<div class="search-container">
    <?= frontend\widgets\searchRacesPanel\SearchRacesPanel::widget(); ?>
</div>
<div class="container">
    <div class="pull-left">
        <h1 class="m-t-3 m-b-3">Календарь соревнований по <?= \sport\models\Sport::getCurrentSportLabel('дательный');?></h1>
    </div>
    <div class="clearfix"></div>
    <a href="http://tyrrussia.ru/?utm_source=trirussia&utm_medium=banner&utm_term=triathlon&utm_campaign=triathlon-sponsorship" class="no-underline" target="_blank">
        <div class="tyr-wrapper">
            <div class="tyr-container">
                <h4 class="m-t-0 m-b-0">TYR — спонсор лучших мировых триатлетов и рубрики «Триатлон» на TriRussia.ru </h4>
            </div>
        </div>
    </a>
    <div class="card card-block">
        <!--<div class="pull-left">
            <div class="form-group m-b-0">
                <select class="c-select small">
                    <option>По дате</option>
                    <option>По популярности</option>
                </select>
            </div>
        </div>-->
        <div class="pull-right">
            <button class="btn btn-sm btn-secondary" id="option1"><i class="fa fa-th" aria-hidden="true"></i></button>
            <button class="btn btn-sm btn-secondary" id="option2"><i class="fa fa-list" aria-hidden="true"></i></button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="row" id="card">
        <ul class="flex-container">
            <?php if (empty($races)) { ?>
                <p><strong>Нет результатов</strong></p>
            <?php } ?>
            <?php /** @var $race \race\models\Race */ ?>
            <?php foreach ($races as $race) {?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <li class="flex-item">
                        <div class="card">
                            <div class="card-block border-<?= $race->getSportClass(); ?>">
                                <div class="pull-left">
                                    <h6 class="sport-caption <?= $race->getSportClass(); ?>"><?= $race->sport->label; ?></h6>
                                </div>
                                <div class="pull-right">
                                    <h6 class="date-caption grey"><?= $race->getDateRepresentation(); ?></h6>
                                </div>
                                <div class="clearfix"></div>
                                <h4 class="card-title">
                                    <?php if ($race->isJoined()) { ?>
                                        <span
                                            class="span-join"
                                            title="Вы участвуете"
                                            data-message-joined="Вы участвуете"
                                            data-message-will="Нажмите, чтобы добавить в календарь"
                                        >
                                    <i
                                        <?= $quest; ?>
                                        class="fa gold fa-star grey i-will-go already-joined"
                                        data-message="will"
                                        aria-hidden="true"
                                        data-id="<?= $race->id; ?>"
                                        data-url="<?= WillGo::dismissUrl(); ?>"
                                    ></i>
                                    <i
                                        <?= $quest; ?>
                                        class="fa fa-star-o grey i-will-go will-join hidden"
                                        aria-hidden="true"
                                        data-message="joined"
                                        data-id="<?= $race->id; ?>"
                                        data-url="<?= WillGo::joinUrl(); ?>"
                                    ></i>
                                </span>
                                    <?php } else { ?>
                                        <span
                                            class="span-join"
                                            title="Нажмите, чтобы добавить в календарь"
                                            data-message-joined="Вы участвуете"
                                            data-message-will="Нажмите, чтобы добавить в календарь"
                                        >
                                            <i
                                                <?= $quest; ?>
                                                class="fa gold fa-star grey i-will-go already-joined hidden"
                                                data-message="will"
                                                aria-hidden="true"
                                                data-id="<?= $race->id; ?>"
                                                data-url="<?= WillGo::dismissUrl(); ?>"
                                            ></i>
                                            <i
                                                <?= $quest; ?>
                                                class="fa fa-star-o grey i-will-go will-join"
                                                aria-hidden="joined"
                                                data-message="will"
                                                data-id="<?= $race->id; ?>"
                                                data-url="<?= WillGo::joinUrl(); ?>"
                                            ></i>
                                        </span>
                                    <?php } ?>
                                    <a href="<?= \yii\helpers\Url::to(['/race/default/view', 'url' => $race->url, ])?>" class="underline-black">
                                        <?= $race->label; ?>
                                    </a>
                                </h4>
                                <p class="card-text"><?= $race->promo; ?></p>
                                <a href="<?= \yii\helpers\Url::to(['/race/default/view', 'url' => $race->url, ])?>" class="btn btn-secondary btn-sm">Узнайте больше</a>
                            </div>
                        </div>
                    </li>
                </div>
            <?php } ?>
        </ul>
    </div>

    <?php if ($showMore) { ?>
    <div class="block block-more-races block-more-races-sport ">
        <button
            type="submit"
            data-lock="0"
            data-url="<?= \race\models\Race::getMoreRacesUrl();?>"
            class="btn btn-success btn-lg more-races"
            data-sport="<?= $_GET['sport']; ?>"
        >
            <strong>Загрузить еще соревнования</strong>
        </button>
    </div>
    <?php } ?>

    <div class="card card-block" id="list">
        <table class="table table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Дата</th>
                <th>Название</th>
                <th>Город</th>
                <th>Дистанция</th>
                <th>Организатор</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($races)) { ?>
                <p><strong>Нет результатов</strong></p>
            <?php } ?>
            <?php /** @var $races \race\models\Race */ ?>
            <?php foreach ($races as $race) {?>
                <tr>
                    <td>
                        <?php if ($race->isJoined()) { ?>
                            <span
                                class="span-join"
                                title="Вы участвуете"
                                data-message-joined="Вы участвуете"
                                data-message-will="Нажмите, чтобы добавить в календарь"
                            >
                                <i
                                    <?= $quest; ?>
                                    class="fa gold fa-star grey i-will-go already-joined"
                                    data-message="will"
                                    aria-hidden="true"
                                    data-id="<?= $race->id; ?>"
                                    data-url="<?= WillGo::dismissUrl(); ?>"
                                ></i>
                                <i
                                    <?= $quest; ?>
                                    class="fa fa-star-o grey i-will-go will-join hidden"
                                    aria-hidden="true"
                                    data-message="joined"
                                    data-id="<?= $race->id; ?>"
                                    data-url="<?= WillGo::joinUrl(); ?>"
                                ></i>
                            </span>
                        <?php } else { ?>   
                            <span
                                class="span-join"
                                title="Нажмите, чтобы добавить в календарь"
                                data-message-joined="Вы участвуете"
                                data-message-will="Нажмите, чтобы добавить в календарь"
                            >
                                <i
                                    <?= $quest; ?>
                                    class="fa gold fa-star grey i-will-go already-joined hidden"
                                    data-message="will"
                                    aria-hidden="true"
                                    data-id="<?= $race->id; ?>"
                                    data-url="<?= WillGo::dismissUrl(); ?>"
                                ></i>
                                <i
                                    <?= $quest; ?>
                                    class="fa fa-star-o grey i-will-go will-join"
                                    aria-hidden="joined"
                                    data-message="will"
                                    data-id="<?= $race->id; ?>"
                                    data-url="<?= WillGo::joinUrl(); ?>"
                                ></i>
                            </span>
                        <?php } ?>

                    </td>
                    <td><?=  date('d.m.Y', strtotime($race->start_date)); ?></td>
                    <td>
	                    <a href="#" data-toggle="tooltip" data-placement="left" class="no-underline" title="<?= $race->sport->label; ?>">
                            <i class="fa fa-circle <?= $race->getSportClass();?>"></i>
                        </a>&nbsp;<a href="<?= \yii\helpers\Url::to(['/race/default/view', 'url' => $race->url, ])?>" class="underline"><?= $race->label; ?></a>
                    </td>
                    <td><?= $race->region ?></td>
                    <td><?= $race->getDistancesRepresentation(); ?></td>
                    <td><?= $race->organizer->label; ?><td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <!--<div class="card">
                <div class="card-block">
                    <h4 class="card-title m-b-0">Все соревнования по триатлону</h4>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <h6>По месяцам</h6>
                            <ul class="list-unstyled">
                                <li><small>В 2016 году</small></li>
                                <li class="leftbar-small"><a href="#" class="underline">Апрель</a><span class="race-count"><small>11</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">Май</a><span class="race-count"><small>13</small></span></li>
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
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
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
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <h6>По странам</h6>
                            <ul class="list-unstyled">
                                <li class="leftbar-small"><a href="#" class="underline">Россия</a><span class="race-count"><small>12</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">Германия</a><span class="race-count"><small>10</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">Беларусь</a><span class="race-count"><small>9</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">Швейцария</a><span class="race-count"><small>8</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">Италия</a><span class="race-count"><small>7</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">Люксембург</a><span class="race-count"><small>1</small></span></li>
                            </ul>
                            <h6>По организаторам</h6>
                            <ul class="list-unstyled">
                                <li class="leftbar-small"><a href="#" class="underline">Ironstar</a><span class="race-count"><small>12</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">Ironman</a><span class="race-count"><small>10</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">A1 Triathlon</a><span class="race-count"><small>9</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">Titan</a><span class="race-count"><small>8</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">New Runners</a><span class="race-count"><small>7</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">3Sport</a><span class="race-count"><small>1</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">Выборгмен</a><span class="race-count"><small>8</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">Challenge</a><span class="race-count"><small>8</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">Шри Чин Мой</a><span class="race-count"><small>8</small></span></li>
                                <li class="leftbar-small"><a href="#" class="underline">МБК</a><span class="race-count"><small>8</small></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>-->

            <div class="race-block-container">
                <?= \frontend\widgets\mostPopularSportRaces\MostPopularSportRaces::widget(); ?>
            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sidebar">
            <div class="ad-sidebar text-xs-center">
                <img src="https://s-media-cache-ak0.pinimg.com/736x/2d/82/a6/2d82a6a6be76603d79a263f05ee96ac8.jpg">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 hidden new-sidebar">
            <div class="ad-sidebar text-xs-center">
                <img src="https://s-media-cache-ak0.pinimg.com/736x/2d/82/a6/2d82a6a6be76603d79a263f05ee96ac8.jpg">
            </div>
        </div>
    </div>
</div>