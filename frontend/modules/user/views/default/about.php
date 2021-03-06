<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\models\UserInfo;

$alertArray = [
    'success',
    'danger',
]
?>

<div class="container">
    <h1 class="m-t-3 m-b-3">Личная информация для регистрации в гонках</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <?php
            foreach ($alertArray as $alert) {
                echo Yii::$app->session->getFlash($alert) ? yii\bootstrap\Alert::widget([
                    'options' => [
                        'class' => 'alert-' . $alert,
                    ],
                    'body' => Yii::$app->session->getFlash($alert),
                ]) : '';
            }
            ?>
            <div class="card card-block">
                <?php $form = ActiveForm::begin([
                    'class' => 'm-t-3',
                    'enableClientValidation' => true,
                    'errorCssClass' => 'has-danger',
                    'successCssClass' => 'has-success',
                    'fieldConfig' => [
                        'options' => [
                            'tag' => 'fieldset',
                            'class' => 'form-group row',
                        ],
                        'inputOptions' => [
                            'class' => 'form-control form-control-danger',
                        ],
                        'labelOptions' => [
                            'class' => 'col-sm-4 form-control-label',
                        ],
                        'errorOptions' => [
                            'class' => 'form-control-feedback small'
                        ],
                        'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8 col-sm-offset-4\">{hint}\n{error}</div>",
                    ],

                ]);?>
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'gender')->dropDownList(UserInfo::getGenderArray(), [
                    'class' => 'c-select',
                ]);?>

                <?= $form->field($model, 'birthdate')->widget(DatePicker::className(), [
                    'name' => 'check_issue_date',
                    'options' => ['placeholder' => 'Выберите дату '],
                    'pluginOptions' => [
                        'format' => 'dd.mm.yyyy',
                        'todayHighlight' => true,
                        'weekStart' => '1',
                    ],
                    'type' => DatePicker::TYPE_INPUT,
                ])->label(); ?>

                <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'team')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'shirt_size')->dropDownList(UserInfo::getShirtSizeArray(), [
                    'class' => 'c-select',
                ]) ?>

                <h3 class="m-t-1 m-b-1">Данные экстренного контакта</h3>

                <?= $form->field($model, 'emergency_first_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'emergency_last_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'emergency_phone')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'emergency_relation')->textInput(['maxlength' => true]) ?>

                <div class="text-xs-right">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-lg']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
