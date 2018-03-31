<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\Url;
use metalguardian\fileProcessor\helpers\FPM;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use organizer\models\Organizer;

/* @var $this yii\web\View */
/* @var $model race\models\Race */
/* @var $form yii\widgets\ActiveForm */




$raceDistanceArray = $model->raceDistanceRefs;
$raceDistanceCount = count($raceDistanceArray);
$model->organizer_label = $model->organizer ? $model->organizer->label : '';
?>

<div class="race-form">

    <div class="box-body">
        <?php $form = ActiveForm::begin([ 'options' => ['enctype' => 'multipart/form-data'], ]); ?>

        <?= $form->field($model, 'coord_lat')->hiddenInput()->label(false); ?>

        <?= $form->field($model, 'coord_lon')->hiddenInput()->label(false); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'created')->widget(DateTimePicker::className(), [
                    'language' => 'ru-RU',
                    'name' => 'datetime_10',
                    'options' => ['placeholder' => 'Выберите дату и время'],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'format' => 'yyyy-MM-dd hh:i',
                        'todayHighlight' => true,

                        'weekStart' => '1',
                    ]
                ]) ?>
            </div>
            <div class="col-md-6">
                <?php
                /*if (!Yii::$app->user->isGuest && Yii::$app->user->identity->getRole() == 'user_role') {
                    $authorData = [Yii::$app->user->identity->id => Yii::$app->user->identity->email];
                }else {
                    $authorData = \user\models\User::getAuthorData();
                }*/
                $authorData = [];
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
                <?= $form->field($model, 'start_date')->widget(\kartik\date\DatePicker::className(), [
                    'name' => 'check_issue_date',
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
                        'start_time',
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
                <?= $form->field($model, 'finish_date')->widget(\kartik\date\DatePicker::className(),
                    [
                        'name' => 'check_issue_date',
                        'value' => date('d-M-Y', strtotime('+2 days')),
                        'options' => ['placeholder' => 'Выберите дату '],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true,

                            'weekStart' => '1',
                        ],
                    ])->label(); ?>
            </div>
        </div>

        

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'label')->textInput([
                    'maxlength' => true,
                    'class' => 'form-control w850 ',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'price')->textInput() ?>

            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'currency')->dropDownList(
                    ['рубли' => 'Рубли', 'доллары' => 'Доллары', 'евро' => 'Евро',],
                    ['class' => 'w130 form-control',]
                ) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'sport_id')->dropDownList(
                    \yii\helpers\ArrayHelper::map(\sport\models\Sport::find()->all(), 'id', 'label'),
                    [
                        'prompt' => '-- Выберите вид спорта --',
                        'id' => 'race-sport-id',
                        'data-value' => $model->sport_id,
                    ]
                ) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'organizer_label')->widget(Select2::className(), [
                    'data' => ArrayHelper::map(Organizer::find()->orderBy(['label' => SORT_ASC])->all(), 'label', 'label'),
                    'theme' => 'default',
                    'options' => ['placeholder' => '-- Выберите организатора --'],
                    'pluginOptions' => [
                        'tags' => true,
                        'tokenSeparators' => [','],
                        'maximumInputLength' => 255
                    ],
                ]);
                ?>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-xs-12">
                <h4>Дистанции</h4>
            </div>
            <div id="race-distance-list" class="col-xs-12" data-count="<?= $raceDistanceCount;?>">
                <?php
                $counter = 1;
                foreach ($raceDistanceArray as $raceDistance) {
                    echo $this->render('includes/distance', [
                        'raceDistance' => $raceDistance,
                        'distanceForSportArray' => $distanceForSportArray,
                        'counter' => $counter,

                    ]);
                    $counter++;
                }
                ?>
            </div>
            <div class="col-xs-12 form-group">
                <?= Html::button('Добавить дистанцию', ['class' => 'btn btn-success race-distance-list-btn-add']);?>
            </div>
        </div>
        <?= $form->field($model, 'special_distance')->textInput(['maxlength' => true, 'id' =>'myTags']) ?>
        <hr>

        <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

        <?php
        $image = $model->main_image_id ? Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($model->main_image_id)) : false;
        if ($image) : ?>
            <div class="form-group">
                <label class="control-label">Превью</label>
                <div class="">
                    <?= $image ?>
                </div>
            </div>
        <?php endif ?>
        <div class="">
            <?= $form->field($model, 'main_image_id')->widget(
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

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'instagram_tag')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'facebook_event_id')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        
        <?= $form->field($model, 'popularity')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'display_type')->dropDownList(\race\models\Race::getTypes()); ?>

        <?= $form->field($model, 'tristats_race_id')->widget(\kartik\select2\Select2::className(), [
            'attribute' => 'tristats_race_id',
            'model' => $model,
            'data' => \yii\helpers\ArrayHelper::map(
                \common\models\TristatsRaces::find()->all(),
                'id',
                'name'
            ),
            'value' => $model->tristats_race_id,
            'theme' => 'default',
            'options' => [
                'placeholder' => 'Выберите гонку',
                'multiple' => false,
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <div id="registration" style="<?= $model->with_registration ? '' : 'display:none;'?>">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'contact_phone')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'date_register_begin')->widget(DateTimePicker::classname(), [
                        'options' => [
                            'placeholder' => 'Введите дату начала регистрации ...',
                            'value' => date('Y-m-d H:i', $model->date_register_begin),
                        ],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'todayHighlight' => true,
                            'weekStart' => '1',
                            'format' => 'yyyy-mm-dd hh:ii'
                        ]
                    ]); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'date_register_end')->widget(DateTimePicker::classname(), [
                        'options' => [
                            'placeholder' => 'Введите дату окончания регистрации ...',
                            'value' => date('Y-m-d H:i', $model->date_register_end),
                        ],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'todayHighlight' => true,
                            'weekStart' => '1',
                            'format' => 'yyyy-mm-dd hh:ii'
                        ]
                    ]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'racers_limit')->textInput(['maxlength' => true])->label('Лимит участников (0 - без лимита)') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'show_racers_list')->dropDownList([
                        0 => 'Нет',
                        1 => 'Да',
                    ]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">

                    <?php if (count($model->raceRegulations)) : ?>
                        <div class="form-group">
                            <label class="control-label">Загруженные положения</label>
                            <ul class="list-unstyled">
                                <?php
                                foreach ($model->raceRegulations as $file) {
                                    echo Html::tag(
                                        'li',
                                        Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', 'javascript:;', ['class' => 'text-danger', 'onClick' => 'deleteRaceFile(' . $model->id .', ' . $file->fpm_file_id . ')']) .
                                        ' - ' .
                                        Html::a($file->file->base_name, FPM::originalSrc($file->fpm_file_id), ['target' => '_blank']),
                                        ['id' => 'race-file-' . $file->fpm_file_id]
                                    );
                                }
                                ?>
                            </ul>
                        </div>
                    <?php endif ?>


                    <?= $form->field($model, 'regulations[]')->widget(
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
                            'options' => ['accept' => 'application/pdf', 'multiple'=>true],
                        ]
                    )->label(); ?>
                </div>
                <div class="col-md-6">
                    <?php if (count($model->raceTraces)) : ?>
                        <div class="form-group">
                            <label class="control-label">Загруженные схемы трасс</label>
                            <ul class="list-unstyled">
                                <?php
                                foreach ($model->raceTraces as $file) {
                                    echo Html::tag(
                                        'li',
                                        Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', 'javascript:;', ['class' => 'text-danger', 'onClick' => 'deleteRaceFile(' . $model->id .', ' . $file->fpm_file_id . ')']) .
                                        ' - ' .
                                        Html::a($file->file->base_name, FPM::originalSrc($file->fpm_file_id), ['target' => '_blank']),
                                        ['id' => 'race-file-' . $file->fpm_file_id]
                                    );
                                }
                                ?>
                            </ul>
                        </div>
                    <?php endif ?>

                    <?= $form->field($model, 'traces[]')->widget(
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
                            'options' => ['accept' => 'image/*,application/pdf', 'multiple'=>true],
                        ]
                    )->label(); ?>
                </div>
            </div>

            <?= $form->field($model, 'register_status')->dropDownList(\race\models\Race::getRegisterStatus()) ?>

        </div>

        <?= $form->field($model, 'published')->hiddenInput(['id' => 'published-field'])->label(false); ?>

        <?= $form->field($model, 'with_registration')->hiddenInput(['id' => 'registration-field'])->label(false); ?>

        <?= $form->field($model, 'country_en')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'region_en')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'place_en')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'label_en')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'currency_en')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'promo_en')->hiddenInput()->label(false); ?>

        <?= $form->field($model, 'content_en')->hiddenInput()->label(false)->hiddenInput()->label(false); ?>

    </div>
    <div class="box-footer">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

            <input type="submit" class="btn btn-default toggle-publication" value="<?= $model->published ? 'Снять с публикации' : 'Опубликовать'; ?>">

            <input type="submit" class="btn btn-default toggle-registration" value="<?= $model->with_registration ? 'Убрать регистрацию' : 'Добавить регистрацию'; ?>">

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
