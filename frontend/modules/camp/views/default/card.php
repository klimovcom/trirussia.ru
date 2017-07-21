<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\components\CountryList;
use yii\helpers\ArrayHelper;

$blockClass = isset($blockClass) ? $blockClass : 'col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4';
?>
<div class="grid-item <?= $blockClass;?>">
    <div class="card card-match-height">
        <div class="card-header white bg-gray">
            <div class="pull-left">
                <p class="m-a-0 small">
                    <span class="flag-icon flag-icon-<?= strtolower((new CountryList())->getCountryCode($model->country));?>"></span>&nbsp;&nbsp;<?= $model->country;?>
                </p>
            </div>
            <div class="pull-right">
                <p class="m-a-0 small">
                    <?= Yii::$app->formatter->asDate(strtotime($model->date_start), 'd MMMM yyyy') . ' — ' . Yii::$app->formatter->asDate(strtotime($model->date_end), 'd MMMM yyyy');?>
                </p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="card-block">
            <h4 class="card-title"><a href="<?= Url::to(['/camp/default/view', 'url' => $model->url]); ?>" class="underline-black"><?= $model->label; ?></a></h4>
            <p class="card-text m-a-0"><?= $model->promo; ?></p>
            <hr>
            <div class="row small">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-muted">
                    Организатор:
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <?= Html::a($model->organizer->label, ['/camp/default/index', 'organizer' => $model->organizer->label], ['class' => 'underline']);?>
                </div>
            </div>
            <?php if ($model->price):?>
                <div class="row small">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-muted">
                        Стоимость:
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                        <?= $model->getPriceRepresentation(); ?>
                    </div>
                </div>
            <?php endif;?>
            <div class="row small">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-muted">
                    Проживание:
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <?= $model->is_accommodation ? 'включено' : 'не включено';?>
                </div>
            </div>
            <div class="row small">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-muted">
                    Длительность:
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <?= $model->getDaysRepresentation(); ?>
                </div>
            </div>
            <div class="row small">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-muted">
                    Виды спорта:
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <?php
                    echo implode(', ', ArrayHelper::getColumn($model->sports, 'label'));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>