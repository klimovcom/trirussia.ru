<?php
use yii\helpers\Url;
use race\models\Race;
use \metalguardian\fileProcessor\helpers\FPM;
use yii\helpers\Html;
use willGo\models\WillGo;
use common\components\CountryList;

if (Yii::$app->user->isGuest) {
    $guest = 'data-toggle="modal" data-target="#openUser"';
    $joinedClass = '';
    $notJoinedClass = '';
}else {
    $guest = '';
    $joinedClass = 'already-joined';
    $notJoinedClass = 'will-join';
}

/**
 * @var $race \race\models\Race
 */
$quest = Yii::$app->user->isGuest ? 'data-toggle="modal" data-target="#openUser"' : '';
?>
<?php if ($showSizer):?>
    <div class="grid-sizer col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
<?php endif;?>
<div class="grid-item col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
    <div class="card">
        <div class="card-header white bg-gr-<?=$race->getSportClass();?>">
            <div class="pull-left">
                <p class="m-a-0 small">
                    <span class="flag-icon flag-icon-<?= strtolower((new CountryList())->getCountryCode($race->country));?>"></span>
                    <?= $race->country;?>
                </p>
            </div>
            <div class="pull-right">
                <p class="m-a-0 small">
                    <?= $race->getDateRepresentation(); ?>
                </p>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php if ($showImage && $race->display_type == Race::DISPLAY_TYPE_BOTH_SIDES):?>
            <a href="<?= $race->getViewUrl(); ?>">
                <div class="embed-responsive embed-responsive-16by9">
                    <img alt="<?= $race->label; ?>" class="card-img-top embed-responsive-item lazy" data-original="<?= FPM::originalSrc($race->main_image_id); ?>">
                </div>
            </a>
        <?php endif;?>
        <div class="card-block">
            <div class="pull-left">
                <h6 class="sport-caption <?=$race->getSportClass();?>">
                    <?= $race->sport->label; ?>
                    <?= $race->getPopularityRepresentation();?>
                </h6>
            </div>
            <div class="pull-right">
                <h6 class="date-caption text-muted">
                    <?php if ($race->isJoined()) { ?>
                        <span
                            class="span-join"
                            title="Вы участвуете"
                            data-message-joined="Вы участвуете"
                            data-message-will="Нажмите, чтобы добавить в календарь"
                            >
                                    <i
                                        <?= $quest; ?>
                                        class="fa fa-bookmark fa-lg gold i-will-go already-joined"
                                        data-message="will"
                                        aria-hidden="true"
                                        data-id="<?= $race->id; ?>"
                                        data-url="<?= WillGo::dismissUrl(); ?>"
                                        ></i>
                                    <i
                                        <?= $quest; ?>
                                        class="fa fa-bookmark-o fa-lg grey i-will-go will-join hidden"
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
                                                class="fa fa-bookmark fa-lg gold i-will-go already-joined hidden"
                                                data-message="will"
                                                aria-hidden="true"
                                                data-id="<?= $race->id; ?>"
                                                data-url="<?= WillGo::dismissUrl(); ?>"
                                                ></i>
                                            <i
                                                <?= $quest; ?>
                                                class="fa fa-bookmark-o fa-lg grey i-will-go will-join"
                                                aria-hidden="joined"
                                                data-message="will"
                                                data-id="<?= $race->id; ?>"
                                                data-url="<?= WillGo::joinUrl(); ?>"
                                                ></i>
                                        </span>
                    <?php } ?>
                </h6>
            </div>
            <div class="clearfix"></div>
            <h4 class="card-title"><a href="<?= $race->getViewUrl(); ?>" class="underline-black"><?= $race->label; ?></a></h4>
            <p class="card-text m-a-0"><?= $race->promo; ?></p>
            <hr>
            <div class="row small">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-muted">
                    Организатор:
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <?= Html::a($race->organizer->label, ['/site/search-races', 'organizer' => $race->organizer->label], ['class' => 'underline']);?>
                </div>
            </div>
            <div class="row small">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-muted">
                    Дистанции:
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <?php
                    $distances = [];
                    foreach ($race->raceDistanceRefs as $raceDistance) {
                        $distances[] = Html::a($raceDistance->distance->label, ['/site/search-races', 'distance' => $raceDistance->distance->label], ['class' => 'underline']);
                    }
                    $special_distances = $race->special_distance ? explode(',', $race->special_distance) : [];
                    if (count($special_distances)) {
                        $distances = array_merge($distances, $special_distances);
                    }
                    echo implode(', ', $distances);
                    ?>
                </div>
            </div>
            <div class="row small">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-muted">
                    Стоимость:
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <?= $race->getPriceRepresentation(); ?>
                </div>
            </div>
        </div>
        <?php if ($showAdditionalBlocks && $race->popularityRate == 5):?>
            <div class="card-footer text-xs-center small" style="background: #fff">
                <i class="fa fa-fire fa-lg" aria-hidden="true" style="color: #cc0000"></i>&nbsp;&nbsp;Очень популярный старт
            </div>
        <?php endif;?>
        <?php if ($showAdditionalBlocks && $race->with_registration):?>
            <div class="card-footer text-xs-center small" style="background-color: #fff;">
                <i class="fa fa-bolt fa-lg gold" aria-hidden="true"></i>&nbsp;&nbsp;Доступна <a href="<?= $race->getViewUrl();?>" class="underline">онлайн-регистрация</a>
            </div>
        <?php endif;?>
    </div>
</div>
