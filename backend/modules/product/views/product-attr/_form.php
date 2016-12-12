<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model product\models\ProductAttr */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-attr-form">

    <div class="box-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'category_id')->dropDownList($categoryArray) ?>

        <?= $form->field($model, 'type')->dropDownList($types) ?>

        <?= $form->field($model, 'position')->textInput() ?>

        <div class="form-group">
            <label class="control-label">Значения</label>
            <div id="product-attr-form-values" class="sortable">
                <?php
                foreach ($values as $value) {
                    echo Html::beginTag('div', ['class' => 'row', 'id' => 'product-attr-value-' . $value->id]);
                    echo Html::beginTag('div', ['class' => 'col-xs-11']);
                    echo Html::input('text', $model->formName() . '[values][' . $value->id . ']', $value->label, ['class' => 'form-control form-control-with-margin']);
                    echo Html::endTag('div');
                    echo Html::beginTag('div', ['class' => 'col-xs-1']);
                    echo Html::a('-', 'javascript:;', ['class' => 'btn btn-danger', 'onClick' => 'deleteAttrValue("#product-attr-value-' . $value->id . '")']);
                    echo Html::endTag('div');
                    echo Html::endTag('div');
                }
                ?>
            </div>
            <a href="javascript:;" class="btn btn-primary" onclick="addAttrValue()">+</a>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>


</div>
