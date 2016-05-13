<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model distance\models\Distance */
/* @var $form yii\widgets\ActiveForm */
/*var_dump($model->getCategoriesArray());
die();*/
?>

<div class="distance-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body">

        <?= $form->field($model, 'label')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'categoriesArray')->widget(\kartik\select2\Select2::className(), [
                    'attribute' => 'categoriesArray',
                    'model' => $model,
                    'data' => \yii\helpers\ArrayHelper::map(\distance\models\DistanceCategory::find()->all(), 'id', 'label'),
                    'value' => $model->getCategoriesArrayValues(),
                    'options' => [ 'placeholder' => 'Выберите категории', 'multiple' => true, ],
                    'pluginOptions' => [
                        'tags' => true,
                        'maximumInputLength' => 10
                    ],
                ]); ?>
            </div>
        </div>

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
