<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use sport\models\Sport;
use training_plan\models\TrainingPlan;

/* @var $this yii\web\View */
/* @var $model training_plan\models\TrainingPlan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-plan-form">

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
                <?= $form->field($model, 'author_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'author_id')->widget(\kartik\select2\Select2::classname(), [
                    'data' => \user\models\User::getAuthorData(),
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
                <?= $form->field($model, 'level')->dropDownList(TrainingPlan::getLevelArray()) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'count')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'progress')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'sport_id')->dropDownList(
                    ArrayHelper::map(Sport::find()->all(), 'id', 'label'),
                    [
                        'prompt' => '-- Выберите вид спорта --',
                    ]
                ) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'duration')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'format')->dropDownList(TrainingPlan::getFormatArray()) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'price')->textInput() ?>
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
                    ],
                    'imageUpload' => Url::to(['/training_plan/training-plan/image-upload']),
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
                    ],
                    'imageUpload' => Url::to(['/training_plan/training-plan/image-upload']),
                ]
            ]
        )->label(); ?>

        <?= $form->field($model, 'published')->hiddenInput(['id' => 'published-field'])->label(false); ?>

        <?= $form->field($model, 'popularity')->hiddenInput()->label(false); ?>
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
    </div>

    <?php ActiveForm::end(); ?>

</div>
