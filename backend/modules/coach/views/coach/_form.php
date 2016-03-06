<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model coach\models\Coach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coach-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created')->widget(\kartik\datetime\DateTimePicker::className(), [
        'name' => 'datetime_10',
        'options' => ['placeholder' => 'Select operating time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd hh:i',
            'startDate' => '01-Mar-2014 12:00 AM',
            'todayHighlight' => true
        ]
    ]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

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

    <?= $form->field($model, 'country')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <?= $form->field($model, 'site')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <?= $form->field($model, 'fb_link')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <?= $form->field($model, 'vk_link')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <?= $form->field($model, 'ig_link')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
