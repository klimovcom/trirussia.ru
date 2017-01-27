<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\select2\Select2;
?>

<div class="container">
    <?php if (!Yii::$app->user->isGuest):?>
        <h1 class="m-t-3 m-b-3">Добавьте новое соревнование</h1>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="card card-block">
                    <h4>Требования</h4>
                    <ul class="m-b-2">
                        <li>Пишите без ошибок</li>
                        <li>Все поля обязательны для заполнения</li>
                        <li>В названии соревнования не указывайте даты</li>
                        <li>В один день может быть несколько соревнований</li>
                        <li>Давайте полное описание</li>
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

                    <?= $form->field($model, 'start_date')->textInput([
                        'maxlength' => true,
                        'class' => 'form-control form-control-danger datepicker',
                    ]) ?>

                    <?= $form->field($model, 'start_time')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'country')->dropDownList($countryList, [
                        'class' => 'c-select',
                    ]);?>

                    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'sport_id')->dropDownList(
                        \yii\helpers\ArrayHelper::map(\sport\models\Sport::find()->all(), 'id', 'label'),
                        [
                            'id' => 'race-create-sport_id',
                            'class' => 'c-select',
                        ]
                    ) ?>

                    <div id="race-create-distance">
                        <?= $distanceList;?>
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
                            ['рубли' => 'Рублей', 'доллары' => 'Долларов', 'евро' => 'Евро',],
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

                    <?= $form->field($model, 'organizer_id')->dropDownList(
                        \yii\helpers\ArrayHelper::map(\organizer\models\Organizer::find()->orderBy(['label' => SORT_ASC])->all(), 'id', 'label'),
                        [
                            'class' => 'c-select select2',
                        ]
                    ) ?>

                    <?= $form->field($model, 'main_image_id', [
                        'template' => "{label}\n<div class=\"col-sm-8\"><label class=\"custom-file\">{input}<span class=\"custom-file-control\"></span></label></div>",
                    ])->fileInput([
                        'class' => 'custom-file-input',
                    ]);?>

                    <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'facebook_event_id')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'promo')->textarea([
                        'rows' => 3,
                        'maxlength' => 100,
                    ]); ?>

                    <?= $form->field($model, 'content')->textarea([
                        'rows' => 6,
                    ]); ?>

                    <div class="text-xs-right">
                        <?= Html::submitButton('Добавить гонку', ['class' => 'btn btn-primary btn-lg']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sidebar">
                <div class="card card-block">
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
                </div>
            </div>
        </div>
    <?php else:?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
		        <h1 class="m-t-3 m-b-3">Добавьте соревнование бесплатно</h1>
		        <p>Это займёт у вас не более 3 минут и после проверки появится на сайте. Для того, чтобы добавить соревнование, вам необходимо зарегистрироваться.</p>
		        <button class="btn btn-primary btn-lg m-t-1" id="login-button" data-toggle="modal" data-target="#openUser">Зарегистрироваться</button>
			</div>
    <?php endif;?>
</div>
