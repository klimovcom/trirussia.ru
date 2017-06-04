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

$zoom = 4;
//Moscow coordinates
$lat = 55.755826;
$lon = 37.6173;
$ind = 'false';
if ($model->coord_lat && $model->coord_lon) {
    $ind = 'true';
    $zoom = 13;
    $lat = $model->coord_lat;
    $lon = $model->coord_lon;
}

$yandexTranslateSecret = Yii::$app->params['yandexTranslateSecret'];

$this->registerCssFile('https://fonts.googleapis.com/css?family=Roboto:300,400,500');
$this->registerJsFile("https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places");
$this->registerJs("
var placeSearch, autocomplete;

window.componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

function translate(content, selector){
    $.post(
            \"https://translate.yandex.net/api/v1.5/tr.json/translate?key=" . $yandexTranslateSecret . "&text=\" +
            content
            + \"&lang=en\",
            {},
             function(response){
                if (response.text)
                    $(selector).val(response.text);
             }
        );
}

function codeAddress(address)
{
  geocoder.geocode( {address:address}, function(results, status)
  {
    if (status == google.maps.GeocoderStatus.OK)
    {
        console.log('results');
        console.log(results);
      map.setCenter(results[0].geometry.location);//center the map over the result
      //place a marker at the location
      var marker = new google.maps.Marker(
      {
          map: map,
          position: results[0].geometry.location
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

function initialize() {
    var mapProp = {
        center:new google.maps.LatLng($lat,$lon),
        zoom:$zoom,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    window.map=new google.maps.Map(document.getElementById(\"googleMap\"),mapProp);

    window.marker = null;
    if ($ind){
        marker = new google.maps.Marker({
            position: {'lat':$lat, 'lng':$lon},
            map: map
        });
    }
    google.maps.event.addListener(map, 'click', function(event) {
        var latitude = event.latLng.lat();
        $(\"#race-coord_lat\").val(latitude);

        var longitude = event.latLng.lng();
        $(\"#race-coord_lon\").val(longitude);

        if (marker){
            marker.setMap(null);
        }
        marker = new google.maps.Marker({
            position: event.latLng,
            map: map
        });
    });
    // Create the autocomplete object, restricting the search
    // to geographical location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
        { types: ['geocode'] });
    // When the user selects an address from the dropdown,
    // populate the address fields in the form.
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        fillInAddress();
    });
}

function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    if (marker){
        marker.setMap(null);
    }
    marker = new google.maps.Marker({
        position: place.geometry.location,
        map: map
    });
    map.setCenter(place.geometry.location);
    map.setZoom(12);
    $('#race-coord_lat').val(place.geometry.location.lat());
    $('#race-coord_lon').val(place.geometry.location.lng());
    for(var i = 0; i < place.address_components.length; i++){
        console.log(place.address_components[i].types);
        if (place.address_components[i].types.indexOf('political') != -1){
            if (place.address_components[i].types.indexOf('country') != -1){
                console.log('here we are 1');
                $('#race-country').val(place.address_components[i].long_name);
                translate(place.address_components[i].long_name, '#race-country_en');
            }
            if (place.address_components[i].types.indexOf('locality') != -1){
                console.log('here we are 2');
                $('#race-region').val(place.address_components[i].short_name);
                translate(place.address_components[i].long_name, '#race-region_en');
            }
        }
        if (place.address_components[i].types.indexOf('point_of_interest') != -1 
            && place.address_components[i].types.indexOf('establishment') != -1){
                console.log('here we are 3');
                $('#race-place').val(place.address_components[i].short_name);
                translate(place.address_components[i].long_name, '#race-place_en');
        }
    }
}

window.geolocate = function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = new google.maps.LatLng(
                position.coords.latitude, position.coords.longitude);
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}

google.maps.event.addDomListener(window, 'load', initialize);

");


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
                if (!Yii::$app->user->isGuest && Yii::$app->user->identity->getRole() == 'user_role') {
                    $authorData = [Yii::$app->user->identity->id => Yii::$app->user->identity->email];
                }else {
                    $authorData = \user\models\User::getAuthorData();
                }
                echo $form->field($model, 'author_id')->widget(\kartik\select2\Select2::classname(), [
                    'data' => $authorData,
                    'language' => 'ru',
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

        <input id="autocomplete" class="form-control google-input" onFocus="geolocate()" type="text" placeholder="Начните вводить адрес..">
        <div id="googleMap" style="height:455px;"></div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">

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
                    'theme' => Select2::THEME_KRAJEE,
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
