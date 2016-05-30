<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model sport\models\Sport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sport-form">

    <div class="box-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'is_on_main')->checkbox() ?>

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

        <?php ActiveForm::end(); ?>
    </div>

</div>
