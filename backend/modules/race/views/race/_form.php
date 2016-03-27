<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model race\models\Race */
/* @var $form yii\widgets\ActiveForm */
$hours = $minutes = null;
if ($model->start_time) {
    $hours = explode(":", $model->start_time)[0];
    $minutes = explode(":", $model->start_time)[1];
}
?>

<div class="race-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>

    <?= $form->field($model, 'created')->widget(DateTimePicker::className(), [
        'language' => 'ru-RU',
        'name' => 'datetime_10',
        'options' => ['placeholder' => 'Выберите дату и время'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd hh:i',
            'todayHighlight' => true,

            'weekStart' => '1',
        ]
    ]) ?>



    <?= $form->field($model, 'author_id')->textInput() ?>

    <?= $form->field($model, 'start_date')->widget(\kartik\date\DatePicker::className(), [
        'name' => 'check_issue_date',
        'value' => date('d-M-Y', strtotime('+2 days')),
        'options' => ['placeholder' => 'Выберите дату '],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,

            'weekStart' => '1',
        ],
    ])->label(); ?>

    <?= $form->field($model, 'finish_date')->widget(\kartik\date\DatePicker::className(),
        [
            'name' => 'check_issue_date',
            'value' => date('d-M-Y', strtotime('+2 days')),
            'options' => ['placeholder' => 'Выберите дату '],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,

                'weekStart' => '1',
            ],
        ])->label(); ?>

    <?= $form->field($model, 'start_time')->hiddenInput() ?>

    <div class="form-group field-race-start_time_picker">
        <input type="text" id="race-start_time_hours" class="form-control timepicker" value="<?= $hours ?>">
        <label for="race-start_time_hours" class="timepicker">часов</label>
        <input type="text" id="race-start_time_minutes" class="form-control timepicker" value="<?= $minutes ?>">
        <label for="race-start_time_minutes" class="timepicker">минут</label>
    </div>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <?= $form->field($model, 'label_en')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <?= $form->field($model, 'sport_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\sport\models\Sport::find()->all(), 'id', 'label')
    ) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'currency')->dropDownList(
        ['рубли' => 'Рубли', 'доллары' => 'Доллары', 'евро' => 'Евро',],
        ['class' => 'w130 form-control',]
    ) ?>

    <?= $form->field($model, 'currency_en')->dropDownList(
        ['рубли' => 'RUR', 'доллары' => 'USD', 'евро' => 'EUR',],
        ['class' => 'w130 form-control',]
    ) ?>

    <?= $form->field($model, 'organizer_id')->dropDownList(\yii\helpers\ArrayHelper::map(\organizer\models\Organizer::find()->all(), 'id', 'label')) ?>

    <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

    <?php
    $image = $model->main_image_id ? Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($model->main_image_id)) : false;
    if ($image) : ?>
        <div class="form-group">
            <label class="control-label">Превью</label>
            <div class="">
                <?= $image ?>
            </div>
        </div>
    <?php endif ?>
    <div class="">
        <?= $form->field($model, 'main_image_id')->widget(
            \kartik\file\FileInput::classname(),
            [
                'pluginOptions' => [
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'browseClass' => 'btn btn-blue btn-primary',
                    'browseIcon' => '',
                    'browseLabel' => 'Загрузить изображение'
                ],
                'options' => ['accept' => 'image/*'],
            ]
        )->label(); ?>
    </div>

    <?= $form->field($model, 'promo')->widget(
        \vova07\imperavi\Widget::className(),
        [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    'clips',
                    'fullscreen'
                ]
            ]
        ]
    )->label(); ?>

    <?= $form->field($model, 'promo_en')->widget(
        \vova07\imperavi\Widget::className(),
        [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    'clips',
                    'fullscreen'
                ]
            ]
        ]
    )->label(); ?>

    <?= $form->field($model, 'content')->widget(
        \vova07\imperavi\Widget::className(),
        [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    'clips',
                    'fullscreen'
                ]
            ]
        ]
    )->label(); ?>

    <?= $form->field($model, 'content_en')->widget(
        \vova07\imperavi\Widget::className(),
        [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    'clips',
                    'fullscreen'
                ]
            ]
        ]
    )->label(); ?>

    <?= $form->field($model, 'instagram_tag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facebook_event_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'published')->checkbox([], false)->label(false) ?>

    <label for="race-published" class="published-label">Опубликовано</label>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
