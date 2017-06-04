<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model coach\models\Coach */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="coach-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],]); ?>
    <div class="box-body">
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
                <?php
                if (!Yii::$app->user->isGuest && Yii::$app->user->identity->getRole() == 'user_role') {
                    $authorData = [Yii::$app->user->identity->id => Yii::$app->user->identity->email];
                }else {
                    $authorData = \user\models\User::getAuthorData();
                }
                echo $form->field($model, 'author_id')->widget(\kartik\select2\Select2::classname(), [
                    'data' => $authorData,
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


        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'label')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>
            </div>
        </div>

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

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'country')->textInput([
                    'maxlength' => true,
                    'class' => 'form-control w850 '
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'site')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'specializationArray')->widget(\kartik\select2\Select2::className(), [
                    'attribute' => 'specializationArray',
                    'model' => $model,
                    'data' =>  \yii\helpers\ArrayHelper::map(\sport\models\Sport::find()->all(), 'id', 'label'),
                    'value' => $model->getSpecializationArrayValues(),
                    'theme' => 'default',
                    'options' => [ 'placeholder' => 'Выберите специализации', 'multiple' => true, ],
                    'pluginOptions' => [
                        'tags' => true,
                        'maximumInputLength' => 10
                    ],
                ]); ?>
            </div>
            <div class="col-md-6">

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
                    ]
                ]
            ]
        )->label(); ?>

        <?= $form->field($model, 'promo')->textarea([ 'maxlength' => true, 'class' => 'form-control w850 ']) ?>

        <?= $form->field($model, 'price')->textarea([ 'maxlength' => true, 'class' => 'form-control w850 ']) ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'fb_link')->textInput([
                    'maxlength' => true,
                    'class' => 'form-control w850 '
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'vk_link')->textInput([
                    'maxlength' => true,
                    'class' => 'form-control w850 '
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'ig_link')->textInput([
                    'maxlength' => true,
                    'class' => 'form-control w850 '
                ]) ?>
            </div>
        </div>

        <?= $form->field($model, 'published')->hiddenInput(['id' => 'published-field'])->label(false); ?>

        <?= $form->field($model, 'is_on_moderation')->hiddenInput(['id' => 'published-field', 'value' => 0])->label(false); ?>

    </div>
    <div class="box-footer">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

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
