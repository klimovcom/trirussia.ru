<?php
use yii\helpers\Html;
use training\models\Training;
use yii\helpers\ArrayHelper;
?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
    <div class="card c-card">
        <div class="card-header white bg-gray">
            <div class="pull-left">
                <p class="m-a-0 small"><?= $model->sport->label;?></p>
            </div>
            <div class="pull-right">
                <p class="m-a-0 small"><?= Yii::$app->formatter->asDate($model->date, 'd MMMM yyyy') . ' г.';?></p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="card-block">
            <h4 class="card-title"><?= $model->label;?></h4>
            <div class="card-text m-a-0"><?= $model->promo;?></div>
            <hr>
            <div class="row small">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 text-muted">
                    Тренер:
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <?= $model->trainer_name;?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 text-muted">
                    Записаться:
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <?= Html::a($model->phone, 'tel:' . $model->phone, ['class' => 'underline']);?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 text-muted">
                    Стоимость:
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <?= $model->priceRepresentation;?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 text-muted">
                    Начало:
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <?= $model->time;?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 text-muted">
                    Длительность:
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <?= $model->length;?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 text-muted">
                    Уровень:
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <?php
                    $levelLabelArray = [];
                    foreach ($model->levels as $level) {
                        if ($levelLabel = ArrayHelper::getValue(Training::getLevelArray(), $level)) {
                            $levelLabelArray[] = $levelLabel;
                        }
                    }
                    echo implode(', ', $levelLabelArray) . '.';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
