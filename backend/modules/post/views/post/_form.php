<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model post\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="post-form">

    <div class="box-body">
        <?php $form = ActiveForm::begin([ 'options' => ['enctype' => 'multipart/form-data'], ]); ?>

        <?= \seo\widgets\SeoWidget::widget(['model' => $model, 'tab' => true]) ?>

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
                <?= $form->field($model, 'author_id')->widget(\kartik\select2\Select2::classname(), [
                    'data' => \user\models\User::getAuthorData(),
                    'language' => 'ru',
                    'theme' => 'default',
                    'options' => ['placeholder' => 'Выберите пользователя'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
        </div>
        <?= $form->field($model, 'label')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <?= $form->field($model, 'content')->widget(
            \vova07\imperavi\Widget::className(),
            [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 200,
                    'plugins' => [
                        'clips',
                        'fullscreen'
                    ],
                    'imageUpload' => Url::to(['/race/race/image-upload']),
                ]
            ]
        )->label(); ?>

		<?= $form->field($model, 'promo')->textarea()->label(); ?>

        <?php
        $image = $model->image_id ? Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($model->image_id)) : false;
        if ($image) : ?>
            <div class="form-group">
                <label class="control-label">Превью</label>
                <div class="">
                    <?= $image ?>
                </div>
            </div>
        <?php endif ?>
        <div class="">
            <?= $form->field($model, 'image_id')->widget(
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
                    'options' => ['accept' => 'image/*'],
                ]
            )->label(); ?>
        </div>

        <?= $form->field($model, 'type')->dropDownList(\post\models\Post::getTypes()) ?>

        <?= $form->field($model, 'featured')->checkbox(); ?>

        <?= $form->field($model, 'tags')->textInput(['maxlength' => true, 'id' =>'myTags']) ?>

        <?= $form->field($model, 'popularity')->textInput() ?>

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
