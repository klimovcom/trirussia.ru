<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use sport\models\Sport;
use training\models\TrainingPlace;
use training\models\Training;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model training\models\Training */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body">

        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?></div>
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
                <?= $form->field($model, 'date')->widget(\kartik\date\DatePicker::className(), [
                    'value' => date('d-M-Y', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Выберите дату '],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,

                        'weekStart' => '1',
                    ],
                ])->label(); ?>
            </div>
            <div class="col-md-6">
                <div class="bootstrap-timepicker">
                    <?= $form->field(
                        $model,
                        'time',
                        [
                            'template' => '{label}
                                                <div class="input-group">
                                                    {input}
                                                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                                </div>
                                                {error}{hint}',
                        ]
                    )->textInput(['class' => 'form-control timepicker',]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'place_id')->dropDownList(
                    ArrayHelper::map(TrainingPlace::find()->all(), 'id', 'label'),
                    [
                        'prompt' => '-- Выберите место --',
                    ]
                ) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'sport_id')->dropDownList(
                    ArrayHelper::map(Sport::find()->all(), 'id', 'label'),
                    [
                        'prompt' => '-- Выберите вид спорта --',
                    ]
                ) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'length')->textInput(['maxlength' => true]);?></div>
            <div class="col-md-6"></div>
        </div>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'trainer_name')->textInput(['maxlength' => true]) ?></div>
            <div class="col-md-6">
                <?= $form->field($model, 'levels')->widget(Select2::className(), [
                    'data' => Training::getLevelArray(),
                    'value' => explode(',', $model->level),
                    'options' => [
                        'placeholder' => '-- Выберите уровни подготовки --',
                        'multiple' => true
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'price')->textInput() ?></div>
            <div class="col-md-6"><?= $form->field($model, 'currency')->dropDownList(Training::getCurrencyArray()) ?></div>
        </div>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?></div>
            <div class="col-md-6"><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>
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
    </div>

    <?php ActiveForm::end(); ?>

</div>
