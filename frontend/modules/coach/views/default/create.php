<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="container">
    <?php if (!Yii::$app->user->isGuest):?>
        <h1 class="m-t-3 m-b-3">Добавьте нового тренера</h1>
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
                        'options' => [
                            'enctype' => 'multipart/form-data'
                        ],

                    ]);?>
                    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'fb_link')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'vk_link')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'ig_link')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'country')->dropDownList($countryList, [
                        'class' => 'c-select',
                    ]);?>

                    <div class="form-group row">
                        <label class="col-sm-4 form-control-label">Специализация</label>
                        <div class="col-sm-8">
                            <?= Html::activeCheckboxList($model, 'specializationArray', $sportsArray, [
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
                        </div>
                    </div>

                    <?= $form->field($model, 'image', [
                        'template' => "{label}\n<div class=\"col-sm-8\"><label class=\"custom-file\">{input}<span class=\"custom-file-control\"></span></label></div>\n<div class=\"col-sm-8 col-sm-offset-4\">{hint}\n{error}</div>",
                    ])->fileInput([
                        'class' => 'custom-file-input',
                    ]);?>

                    <?= $form->field($model, 'promo')->textarea([
                        'rows' => 3,
                        'maxlength' => 100,
                    ]); ?>

                    <?= $form->field($model, 'content')->textarea([
                        'rows' => 6,
                    ]); ?>

                    <?= $form->field($model, 'price')->textarea([
                        'rows' => 3,
                        'maxlength' => 100,
                    ]); ?>

                    <div class="text-xs-right">
                        <?= Html::submitButton('Добавить тренера', ['class' => 'btn btn-primary btn-lg']) ?>
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
                <h1 class="m-t-3 m-b-3">Добавьте тренера бесплатно</h1>
                <p>Это займёт у вас не более 3 минут и после проверки появится на сайте. Для того, чтобы добавить тренера, вам необходимо зарегистрироваться.</p>
                <button class="btn btn-primary btn-lg m-t-1" id="login-button" data-toggle="modal" data-target="#openUser">Зарегистрироваться</button>
            </div>
        </div>
    <?php endif;?>
</div>
