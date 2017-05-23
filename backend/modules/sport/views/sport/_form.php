<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model sport\models\Sport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sport-form">

    <div class="box-body">
        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>

        <?= \seo\widgets\SeoWidget::widget(['model' => $model, 'tab' => true]) ?>

        <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

        <?php
        $image = $model->icon_id ? Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($model->icon_id)) : false;
        if ($image) : ?>
            <div class="form-group">
                <label class="control-label">Превью</label>
                <div class="">
                    <?= $image ?>
                </div>
            </div>
        <?php endif ?>
        <div class="">
            <?= $form->field($model, 'icon_id')->widget(
                \kartik\file\FileInput::classname(),
                [
                    'pluginOptions' => [
                        'showCaption' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                        'browseClass' => 'btn btn-blue btn-primary',
                        'browseIcon' => '',
                        'browseLabel' => 'Загрузить иконку'
                    ],
                    'options' => ['accept' => 'image/*'],
                ]
            )->label(); ?>
        </div>

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
