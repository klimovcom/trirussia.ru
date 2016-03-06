<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model race\models\RaceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="race-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created') ?>

    <?= $form->field($model, 'author_id') ?>

    <?= $form->field($model, 'start_date') ?>

    <?= $form->field($model, 'finish_date') ?>

    <?php // echo $form->field($model, 'start_time') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'region') ?>

    <?php // echo $form->field($model, 'place') ?>

    <?php // echo $form->field($model, 'label') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'organizer_id') ?>

    <?php // echo $form->field($model, 'site') ?>

    <?php // echo $form->field($model, 'main_image_id') ?>

    <?php // echo $form->field($model, 'promo') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'instagram_tag') ?>

    <?php // echo $form->field($model, 'facebook_event_id') ?>

    <?php // echo $form->field($model, 'published') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
