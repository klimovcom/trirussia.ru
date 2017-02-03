<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\promocode\models\Promocode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promocode-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'discount')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'promocode')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <?= $form->field($model, 'promo')->widget(
            \vova07\imperavi\Widget::className(),
            [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 200,
                    'plugins' => [
                        'clips',
                        'fullscreen'
                    ]
                ]
            ]
        )->label(); ?>

        <?= $form->field($model, 'conditions')->widget(
            \vova07\imperavi\Widget::className(),
            [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 200,
                    'plugins' => [
                        'clips',
                        'fullscreen'
                    ]
                ]
            ]
        )->label(); ?>
    </div>

    <?= $form->field($model, 'published')->hiddenInput(['id' => 'published-field'])->label(false); ?>

    <div class="box-footer">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

            <input type="submit" class="btn btn-default toggle-publication" value="<?= $model->published ? 'Снять с публикации' : 'Опубликовать'; ?>">

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
