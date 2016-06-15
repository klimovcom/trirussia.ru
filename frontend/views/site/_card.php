<?php
use yii\helpers\Url;
use race\models\Race;
use \metalguardian\fileProcessor\helpers\FPM;


/**
 * @var $race \race\models\Race
 */

/*var_dump($race->organizer->image_id);
var_dump($race->organizer->label);
die();*/
?>
<div class="grid-sizer col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
<div class="grid-item col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
    <div class="grid-item-content">
        <div class="card <?= $race->display_type == Race::DISPLAY_TYPE_BLACK_HIDE_IMAGE ? 'bg-black' : ''; ?>">
            <div class="card-img-caption-container">
                <?php if ($race->main_image_id && $race->isShowImage()) { ?>
                    <a href="<?= Url::to(['/race/default/view', 'url' => $race->url,]) ?>">
                        <img class="card-img-top img-fluid"
                             src="<?= FPM::originalSrc($race->main_image_id); ?>"
                             alt="Card image cap">
                    </a>
                    <div class="card-img-caption bg-<?= $race->getSportClass(); ?>">
                        <small>
                            Популярность&nbsp;
                            <?= $race->getPopularityRepresentation();?>
                        </small>
                        <!--<div class="pull-right">
                            <div class="card-participant">
                                <span class="small"><strong><i class="fa fa-star fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;Вы
                                        участвуете</strong></span>
                            </div>
                        </div>-->
                    </div>
                <?php } ?>
            </div>
            <div class="card-block border-<?= $race->getSportClass(); ?>">
                <div class="pull-left">
                    <h6 class="sport-caption <?= $race->getSportClass(); ?>"><?= $race->sport->label; ?></h6>
                </div>
                <div class="pull-right">
                    <h6 class="date-caption grey"><?= $race->getDateRepresentation(); ?></h6>
                </div>
                <div class="clearfix"></div>
                <h4 class="card-title">
                    <a href="<?= Url::to(['/race/default/view', 'url' => $race->url,]) ?>" class="underline-black">
                        <?= $race->label; ?>
                    </a>
                </h4>
                <p class="card-text"><?= $race->promo; ?></p>
            </div>
            <div style="height: 3rem;"></div>
            <div class="next-page">
                <div class="pull-left">
                    <span class="PTSerif"><i><?= $race->organizer->label; ?></i></span>
                </div>
                <div class="pull-right">
                    <a href="<?= Url::to(['/race/default/view', 'url' => $race->url,]) ?>" class="btn btn-secondary btn-sm">Узнайте больше</a>
	            </div>
            </div>
            <?php if ($race->display_type == Race::DISPLAY_TYPE_BOTH_SIDES) { ?>
                <div class="next-page">
                    <div class="pull-left">
                        <?php if ($race->organizer->image_id) { ?>
                            <img src="<?= FPM::originalSrc($race->organizer->image_id)?>" class="card-organizer-logo">
                        <?php } else { ?>
                            <span class="PTSerif"><i><?= $race->organizer->label; ?></i></span>
                        <?php }  ?>
                    </div>
                    <div class="pull-right">
                        <span class="next-page-button text-muted"><span class="small">Перевернуть&nbsp;&nbsp;</span><i
                                class="fa fa-retweet fa-lg" aria-hidden="true"></i></span>
                    </div>
                </div>
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
                                <a href="<?= Url::to(['/race/default/view', 'url' => $race->url,]) ?>" type="button"
                                   class="btn btn-secondary btn-block m-t-2">Узнать подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div style="height: 3rem;"></div>
                    <div class="next-page">
                        <div class="pull-left">
                            <?php if ($race->organizer->image_id) { ?>
                                <img src="<?= FPM::originalSrc($race->organizer->image_id)?>" class="card-organizer-logo">
                            <?php } else { ?>
                                <span class="PTSerif"><i>Организатор</i></span>
                            <?php }  ?>
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
