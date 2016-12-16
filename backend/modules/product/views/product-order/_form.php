<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model product\models\ProductOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'time')->dropDownList($timeArray) ?>

        <?= $form->field($model, 'cost')->textInput() ?>

        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'status')->dropDownList($statusArray) ?>
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
