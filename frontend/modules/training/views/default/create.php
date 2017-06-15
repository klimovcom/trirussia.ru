<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use training\models\TrainingPlace;
use yii\widgets\ActiveForm;
use sport\models\Sport;
use training\models\Training;
?>
<div class="container">
    <h1 class="m-t-3 m-b-3">Добавьте тренировку бесплатно</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card card-block">
                <?= Yii::$app->session->getFlash('trainer-create-success') ?
                    \yii\bootstrap\Alert::widget([
                        'options' => [
                            'class' => 'alert-success',
                        ],
                        'body' => Yii::$app->session->getFlash('trainer-create-success'),
                    ]) : ''?>
                <h4>Требования</h4>
                <ul>
                    <li>Пишите без ошибок</li>
                    <li>Все поля обязательны для заполнения</li>
                    <li>В названии не указывайте даты</li>
                    <li>Тренировка с описанием смотрится лучше</li>
                    <li>Ссылки <strong>запрещены</strong></li>
                </ul>
                <hr>
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
                <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'date')->textInput([
                    'maxlength' => true,
                    'class' => 'form-control form-control-danger datepicker',
                ]) ?>

                <?= $form->field($model, 'time')->textInput(['id' => 'form-training-add-time', 'maxlength' => true]) ?>

                <?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'place_id', [
                    'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8 col-sm-offset-4\">{hint}\n{error}</div>\n<div class=\"col-sm-8 col-sm-offset-4\"><small class=\"text-muted\">Если места нет в списке, укажите его в описании</small></div>",
                ])->dropDownList(ArrayHelper::map(TrainingPlace::find()->orderBy('label')->all(), 'id', 'label'), [
                    'class' => 'c-select',
                ]);?>

                <?= $form->field($model, 'sport_id')->dropDownList(ArrayHelper::map(Sport::find()->all(), 'id', 'label'), [
                    'class' => 'c-select',
                ]);?>

                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">Уровень</label>
                    <div class="col-sm-8">
                        <?= Html::activeCheckboxList($model, 'levels', Training::getLevelArray(), [
                            'item'=>function ($index, $label, $name, $checked, $value){
                                return Html::beginTag('div', ['class' => 'checkbox']) .
                                Html::beginTag('label') .
                                Html::checkbox($name, $checked, [
                                    'value' => $value,
                                ]) .
                                ' ' . $label .
                                Html::endTag('label') .
                                Html::endTag('div');
                            },
                        ]);?>
                        <?= Html::error($model,'levels', ['class' => 'small text-danger']);?>
                    </div>
                </div>

                <div class="form-group row">
                    <?= $form->field($model, 'price', [
                        'options' => [
                            'tag' => false
                        ],
                        'template' => "{label}\n<div class=\"col-sm-3\">{input}</div>",
                    ])->textInput() ?>

                    <?= $form->field($model, 'currency', [
                        'options' => [
                            'tag' => false
                        ],
                        'template' => "<div class=\"col-sm-5\">{input}</div>",
                    ])->radioList(
                        Training::getCurrencyArray(),
                        [
                            'class' => 'btn-group',
                            'data-toggle' => 'buttons',
                            'itemOptions' => [
                                'labelOptions' => [
                                    'class' => 'btn btn-secondary',
                                ]
                            ],
                        ]
                    ) ?>
                </div>

                <?= $form->field($model, 'trainer_name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'promo')->textarea([
                    'rows' => 3,
                    'maxlength' => 100,
                ]); ?>

                <?= $form->field($model, 'published')->hiddenInput()->label(false);?>

                <div class="text-xs-right">
                    <?= Html::submitButton('Добавить тренировку', ['class' => 'btn btn-primary btn-lg']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

            <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 30px; left: 1156.5px;"><div class="card card-block">
                    <h4>Пример заполнения</h4>
                    <ul class="list-unstyled">
                        <li><span class="text-muted">Название:</span> <span class="PTSerif"><i>Московский марафон</i></span></li>
                        <li><span class="text-muted">Дата старта:</span> <span class="PTSerif"><i>25.09.2016</i></span></li>
                        <li><span class="text-muted">Время старта:</span> <span class="PTSerif"><i>9:10</i></span></li>
                        <li><span class="text-muted">Страна:</span> <span class="PTSerif"><i>Росссия</i></span></li>
                        <li><span class="text-muted">Город:</span> <span class="PTSerif"><i>Москва</i></span></li>
                        <li><span class="text-muted">Место:</span> <span class="PTSerif"><i>Лужники</i></span></li>
                        <li><span class="text-muted">Вид спорта:</span> <span class="PTSerif"><i>Бег</i></span></li>
                        <li><span class="text-muted">Дистанция:</span> <span class="PTSerif"><i>Марафон, 10 км</i></span></li>
                        <li><span class="text-muted">Стоимость участия:</span> <span class="PTSerif"><i>1500 рублей</i></span></li>
                        <li><span class="text-muted">Организатор:</span> <span class="PTSerif"><i>Московский марафон</i></span></li>
                        <li><span class="text-muted">Ссылка на официальный сайт:</span> <span class="PTSerif"><i>http://moscowmarathon.org/ru/</i></span></li>
                        <li><span class="text-muted">Номер из ссылки на мероприятие в Фейбсуке:</span> <span class="PTSerif"><i>1562344640750526</i></span></li>
                        <li><span class="text-muted">Краткое описание:</span> <span class="PTSerif"><i>Главное беговое событие города. Ещё больше участников со всего мира и прекрасная экскурсия по городу</i></span></li>
                    </ul>
                </div></div></div>
    </div>
</div>