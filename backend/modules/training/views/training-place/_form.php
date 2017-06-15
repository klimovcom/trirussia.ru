<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model training\models\TrainingPlace */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-place-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body">
        <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="box-footer">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

            <?= $model->isNewRecord ? '' : Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger pull-right',
                'data' => [
                    'confirm' => 'Вы действительно хотите удалить этот объект?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
