<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model product\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <div class="box-body">
        <?php $form = ActiveForm::begin([ 'options' => ['enctype' => 'multipart/form-data'], ]); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'created')->widget(\kartik\datetime\DateTimePicker::className(), [
                    'name' => 'datetime_10',
                    'options' => ['placeholder' => 'Выберите дату и время'],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'format' => 'yyyy-MM-dd hh:i',
                        'startDate' => '01-Mar-2014 12:00 AM',
                        'todayHighlight' => true,

                        'weekStart' => '1',
                    ]
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'id' => 'product-url']) ?>
            </div>
        </div>

        <?= $form->field($model, 'label')->textInput(['maxlength' => true, 'class' => 'form-control w850', 'id' => 'product-label']) ?>

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

        <?= $form->field($model, 'content')->widget(
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

        <?php
        if (count($model->productImages)) : ?>
            <div class="form-group">
                <label class="control-label">Превью</label>
                <div class="row">
                    <?php
                    foreach ($model->productImages as $image) {
                        echo Html::beginTag('div', ['id' => 'product-images-' . $image->id,'class' => 'col-xs-4']);
                        echo Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($image->image_id), ['class' => 'img-responsive form-control-with-margin']);
                        echo Html::a('Удалить', 'javascript:;', ['class' => 'btn btn-danger', 'onClick' => 'deleteProductImage(' . $image->id .')']);
                        echo Html::endTag('div');
                    }
                    ?>
                </div>
            </div>
        <?php endif ?>
        <div class="">
            <?= $form->field($model, 'images[]')->widget(
                \kartik\file\FileInput::classname(),
                [
                    'pluginOptions' => [
                        'showCaption' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                        'browseClass' => 'btn btn-blue btn-primary',
                        'browseIcon' => '',
                        'browseLabel' => 'Загрузить изображение'
                    ],
                    'options' => ['accept' => 'image/*', 'multiple'=>true],
                ]
            )->label(); ?>
        </div>

        <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(\product\models\ProductCategory::find()->all(), 'id', 'label'), ['id' => 'product_category_id', 'prompt' => 'Выберите категорию']);?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'price')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'popularity')->textInput() ?>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Атрибуты</label>

            <div id="product-attr">
                <?= $this->render('_attr', ['attrs' => $attrs, 'checkedAttr' => $checkedAttr]);?>
            </div>
        </div>


        <?= $form->field($model, 'published')->hiddenInput(['id' => 'published-field'])->label(false); ?>


    </div>
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

        <?php ActiveForm::end(); ?>
    </div>

</div>
