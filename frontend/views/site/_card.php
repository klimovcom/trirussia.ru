<?php
use yii\helpers\Url;
use race\models\Race;
use \metalguardian\fileProcessor\helpers\FPM;
use yii\helpers\Html;
use willGo\models\WillGo;

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

if ($race->display_type == Race::DISPLAY_TYPE_HIDE_IMAGE) {
    $organizerLabel = Html::tag('span', Html::tag('i', $race->organizer->label), ['class' => 'PTSerif']);
}else {
    $organizerLabel = $race->organizer->image_id ?
        Html::img(FPM::originalSrc($race->organizer->image_id), ['alt' => $race->organizer->label, 'title' => $race->organizer->label, 'class' => 'card-organizer-logo']) :
        Html::tag('span', Html::tag('i', $race->organizer->label), ['class' => 'PTSerif']);
}
?>
<div class="grid-sizer col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
<div class="grid-item col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
    <div class="grid-item-content">
        <div class="card <?= $race->display_type == Race::DISPLAY_TYPE_BLACK_HIDE_IMAGE ? 'bg-black' : ''; ?>">
            <?php if (empty($_GET['sport']) && empty($_POST['sport'])) { ?>
                <div class="card-img-caption-container">
                    <?php if ($race->main_image_id && $race->isShowImage()) { ?>
                        <a href="<?= $race->getViewUrl(); ?>">
                            <div class="embed-responsive embed-responsive-16by9">
                                <img alt="<?= $race->label; ?>" class="card-img-top embed-responsive-item lazy" data-original="<?= FPM::originalSrc($race->main_image_id); ?>">
                            </div>
                        </a>
                        <div class="card-img-caption bg-<?= $race->getSportClass(); ?>">
                            <small>
                                Популярность&nbsp;
                                <?= $race->getPopularityRepresentation();?>
                            </small>
                            <div class="pull-right">
                                <div class="card-participant">
                                    <?php if ($race->isJoined()):?>
                                        <a href="javascript:;" type="button" class="btn btn-white-outline btn-sm <?= $joinedClass;?>" <?= $guest;?> data-id="<?= $race->id; ?>" data-url="<?= WillGo::dismissUrl(); ?>"><img src="img/join_race.png" class="join-race" > <?= $race->attendance;?></a>
                                        <a href="javascript:;" type="button" class="btn btn-white-outline btn-sm hidden <?= $notJoinedClass;?>" <?= $guest;?> data-id="<?= $race->id; ?>" data-url="<?= WillGo::joinUrl(); ?>"><img src="img/join_race.png" class="join-race"> <?= $race->attendance-1;?></a>
                                    <?php else:?>
                                        <a href="javascript:;" type="button" class="btn btn-white-outline btn-sm hidden <?= $joinedClass;?>" <?= $guest;?> data-id="<?= $race->id; ?>" data-url="<?= WillGo::dismissUrl(); ?>"><img src="img/join_race.png" class="join-race"> <?= $race->attendance+1;?></a>
                                        <a href="javascript:;" type="button" class="btn btn-white-outline btn-sm <?= $notJoinedClass;?>" <?= $guest;?> data-id="<?= $race->id; ?>" data-url="<?= WillGo::joinUrl(); ?>"><img src="img/join_race.png" class="join-race"> <?= $race->attendance;?></a>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="card-block border-<?= $race->getSportClass(); ?>">
                <div class="pull-left">
                    <h6 class="sport-caption <?= $race->getSportClass(); ?>"><?= $race->sport->label; ?></h6>
                </div>
                <div class="pull-right">
                    <h6 class="date-caption grey"><?= $race->getDateRepresentation(); ?></h6>
                </div>
                <div class="clearfix"></div>
                <h4 class="card-title">
                    <a href="<?= $race->getViewUrl(); ?>" class="underline-black">
                        <?= $race->label; ?>
                    </a>
                </h4>
                <p class="card-text"><?= $race->promo; ?></p>
            </div>
            <div style="height: 3rem;"></div>
            <div class="next-page">
                <div class="pull-left">
                    <?= $organizerLabel;?>
                </div>
                <?php if ($race->display_type == Race::DISPLAY_TYPE_BOTH_SIDES) : ?>
                <div class="pull-right">
                        <span class="next-page-button text-muted"><span class="small">Перевернуть&nbsp;&nbsp;</span><i
                                class="fa fa-retweet fa-lg" aria-hidden="true"></i></span>
                </div>
                <?php endif ?>
            </div>
            <?php if ($race->display_type == Race::DISPLAY_TYPE_BOTH_SIDES) { ?>
                <div class="card-back">
                    <div class="card-top bg-<?= $race->getSportClass(); ?>">
                        <h6 class="sport-caption white text-xs-center m-b-0"><?= $race->sport->label; ?></h6>
                    </div>
                    <div class="card-block">
                        <div class="card-container-no-border bg-light-grey">
                            <div class="row">
                                <div class="col-md-4 col-lg-2 col-xl-2 hidden-sm-down">
                                    <img src="img/distance.png" class="distance">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
                                    <h6>Дистанции</h6>
                                    <?= $race->getDistancesListRepresentation(); ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-lg-2 col-xl-2 hidden-sm-down">
                                    <img src="img/map.png" class="map">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 col-xl-10">
                                    <h6>Место</h6>
                                    <p><?= $race->getPlaceRepresentation();?></p>
                                </div>
                            </div>
                            <div class="text-xs-center">
                                <a href="<?= $race->getViewUrl(); ?>" type="button"
                                   class="btn btn-secondary btn-block m-t-2">Узнать подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div style="height: 3rem;"></div>
                    <div class="next-page">
                        <div class="pull-left">
                            <?= $organizerLabel;?>
                        </div>
                        <div class="pull-right">
                            <span class="next-page-button text-muted"><span class="small">Обратно&nbsp;&nbsp;</span><i
                                    class="fa fa-retweet fa-lg" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
