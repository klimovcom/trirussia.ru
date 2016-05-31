<?php

use \yii\helpers\Url;

/**
 * @var $this \yii\base\View
 * @var $model \frontend\models\SearchRaceForm
 * @var $countries array
 * @var $organizers array
 */
$dateIntervals = \frontend\widgets\searchRacesPanel\SearchRacesPanel::getDateIntervals();
?>

<div class="container">
    <?= \yii\helpers\Html::beginForm(
        Url::toRoute(array_merge(['/'], $_GET)), 'post', [
            'id' => 'search-race-form',
            'class' => 'form-inline',
            'data-update-distances-url' => Url::toRoute('/race/default/update-search-distance'),
            'data-update-url' => Url::toRoute('/race/default/update-url'),
        ]
    ); ?>
        <div class="form-group">
            <?= \yii\helpers\Html::activeDropDownList(
                $model,
                'date',
                $dateIntervals,
                ['prompt' => 'Выберите время', 'class' => 'c-select small', ]
            ) ?>
        </div>
        <div class="form-group">
            <div class="form-group">
                <?= \yii\helpers\Html::activeDropDownList(
                    $model,
                    'sport',
                    \yii\helpers\ArrayHelper::map(\sport\models\Sport::find()->all(), 'id', 'label'),
                    ['prompt' => 'Выберите вид спорта', 'class' => 'c-select small', ]
                ) ?>
            </div>
        </div>
        <div class="form-group">
            <?= \yii\helpers\Html::activeDropDownList(
                $model,
                'distance',
                \yii\helpers\ArrayHelper::map(\distance\models\DistanceCategory::find()->where(['sport_id' => $model->sport])->all(), 'label', 'label'),
                ['prompt' => 'Выберите дистанцию', 'class' => 'c-select small', ]
            ) ?>
        </div>
        <div class="form-group">
            <?= \yii\helpers\Html::activeDropDownList(
                $model,
                'country',
                $countries,
                ['prompt' => 'Выберите страну', 'class' => 'c-select small', ]
            ) ?>
        </div>
        <div class="form-group">
            <?= \yii\helpers\Html::activeDropDownList(
                $model,
                'organizer',
                \yii\helpers\ArrayHelper::map($organizers, 'label', 'label'),
                ['prompt' => 'Выберите организатора', 'class' => 'c-select small', ]
            ) ?>
        </div>
        <div class="pull-right">
            <?= \yii\helpers\Html::submitButton('Найти', ['class'=>"btn btn-primary btn-sm", 'id' => 'search-sumbit', ]); ?>
        </div>
    <?= \yii\helpers\Html::endForm(); ?>
</div>
