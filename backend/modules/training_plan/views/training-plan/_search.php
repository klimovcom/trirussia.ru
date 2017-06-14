<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model training_plan\models\TrainingPlanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-plan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'label') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'level') ?>

    <?= $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'progress') ?>

    <?php // echo $form->field($model, 'author_id') ?>

    <?php // echo $form->field($model, 'author_name') ?>

    <?php // echo $form->field($model, 'format') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'duration') ?>

    <?php // echo $form->field($model, 'sport') ?>

    <?php // echo $form->field($model, 'popularity') ?>

    <?php // echo $form->field($model, 'info') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
