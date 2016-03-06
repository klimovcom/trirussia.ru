<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model race\models\Race */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="race-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>

    <?= $form->field($model, 'created')->widget(DateTimePicker::className(), [
        'name' => 'datetime_10',
        'options' => ['placeholder' => 'Select operating time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd hh:i',
            'todayHighlight' => true
        ]
    ]) ?>



    <?= $form->field($model, 'author_id')->textInput() ?>

    <?= $form->field($model, 'start_date')->widget(\kartik\date\DatePicker::className(), [
        'name' => 'check_issue_date',
        'value' => date('d-M-Y', strtotime('+2 days')),
        'options' => ['placeholder' => 'Select issue date ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ],
    ])->label(); ?>

    <?= $form->field($model, 'finish_date')->widget(\kartik\date\DatePicker::className(),
        [
            'name' => 'check_issue_date',
            'value' => date('d-M-Y', strtotime('+2 days')),
            'options' => ['placeholder' => 'Select issue date ...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ],
        ])->label(); ?>

    <?= $form->field($model, 'start_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <?= $form->field($model, 'label_en')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organizer_id')->textInput() ?>

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

    <?= $form->field($model, 'published')->checkbox([], false)->label() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
