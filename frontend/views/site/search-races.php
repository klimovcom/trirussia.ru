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
        <h1 class="m-t-3 m-b-3">Календарь соревнований</h1>
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
                                    aria-hidden="true"
                                    data-message="joined"
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

    <?php if ($showMore) { ?>
        <div class="block block-more-races block-more-races-sport ">
            <button
                type="submit"
                data-lock="0"
                data-url="<?= \race\models\Race::getMoreRacesUrl();?>"
                data-target="<?= \race\models\Race::getMoreRacesTarget();?>"
                data-target-list="<?= \race\models\Race::getMoreRacesTargetList();?>"
                data-render-type="<?= \race\models\Race::getMoreRacesRenderType();?>"
                class="btn btn-primary more-races"
                data-sport="<?= isset($_GET['sport']) ? $_GET['sport'] : null; ?>"
                data-date="<?= isset($_GET['date']) ? $_GET['date'] : null; ?>"
                data-distance="<?= isset($_GET['distance']) ? $_GET['distance'] : null; ?>"
                data-country="<?= isset($_GET['country']) ? $_GET['country'] : null; ?>"
                data-organizer="<?= isset($_GET['organizer']) ? $_GET['organizer'] : null; ?>"
            >
                Загрузить еще соревнования
            </button>
        </div>
    <?php } ?>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card">
                <?= \frontend\widgets\allRaces\AllRaces::widget() ?>
            </div>
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