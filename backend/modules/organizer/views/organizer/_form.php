<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model organizer\models\Organizer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organizer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created')->widget(\kartik\datetime\DateTimePicker::className(), [
        'name' => 'datetime_10',
        'options' => ['placeholder' => 'Выберите дату и время'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd hh:i',
            'startDate' => '01-Mar-2014 12:00 AM',
            'todayHighlight' => true,

            'weekStart' => '1',
        ]
    ]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php
    $image = $model->image_id ? Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($model->image_id)) : false;
    if ($image) : ?>
        <div class="form-group">
            <label class="control-label">Превью</label>
            <div class="">
                <?= $image ?>
            </div>
        </div>
    <?php endif ?>
    <div class="">
        <?= $form->field($model, 'image_id')->widget(
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

    <?= $form->field($model, 'content')->widget(
        Widget::className(),
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

    <?= $form->field($model, 'promo')->widget(
        Widget::className(),
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

    <?= $form->field($model, 'published')->checkbox([], false)->label(false) ?>

    <label for="race-published" class="published-label">Опубликовано</label>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
