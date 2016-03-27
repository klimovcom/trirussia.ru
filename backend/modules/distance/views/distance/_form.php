<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model distance\models\Distance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="distance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sport_id')->textInput() ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
