<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model coach\models\CoachSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coach-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created') ?>

    <?= $form->field($model, 'label') ?>

    <?= $form->field($model, 'image_id') ?>

    <?= $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'site') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'fb_link') ?>

    <?php // echo $form->field($model, 'vk_link') ?>

    <?php // echo $form->field($model, 'ig_link') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
