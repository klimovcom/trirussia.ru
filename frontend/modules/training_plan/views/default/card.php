<?php
use training_plan\models\TrainingPlan;
use yii\helpers\Html;
?>
<div class="<?= $cardClass;?>">
    <div class="card white bg-gr-<?= $model->sportClass;?>">
        <div class="card-block c-card">
            <div class="pull-left">
                <h6 class="sport-caption white">
                    <?= $model->label;?>
                </h6>
            </div>
            <div class="pull-right">
                <h6 class="sport-caption white">
                    <?= $model->duration;?>
                </h6>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div class="row small">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    Уровень подготовки:
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <span class="small">
                        <?php
                        for ($i = 0; $i < 5; $i++) {
                            if ($i < $model->level) {
                                echo '<i class="fa fa-circle" aria-hidden="true"></i> ';
                            }else {
                                echo '<i class="fa fa-circle c-semi-transparent" aria-hidden="true"></i> ';
                            }

                        }
                        ?>
                    </span>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    Тренировки:
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <?= $model->count;?>  в неделю
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    Объём:
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <?= $model->amount;?> в неделю
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    Начало → конец:
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <?= $model->progress;?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    Автор:
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <?= $model->author_name;?>
                </div>
            </div>
        </div>
        <div class="card-footer p-y-1" style="background-color: #fff; color: #373a3c">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 small">
                    <span class="text-muted">Формат:<br></span>
                    <?= TrainingPlan::getFormatArray()[$model->format];?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-xs-right">
                    <?= Html::a($model->price . ' ₽', ['/training_plan/default/view', 'url' => $model->url], ['class' => 'btn btn-primary-outline']);?>
                </div>
            </div>
        </div>
    </div>
</div>