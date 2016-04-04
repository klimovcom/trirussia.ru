<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model race\models\Race */
/* @var $form yii\widgets\ActiveForm */
$hours = $minutes = null;
if ($model->start_time) {
    $hours = explode(":", $model->start_time)[0];
    $minutes = explode(":", $model->start_time)[1];
}

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

function codeAddress(address)
{
  geocoder.geocode( {address:address}, function(results, status)
  {
    if (status == google.maps.GeocoderStatus.OK)
    {
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

    var marker = null;
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
    map.setCenter(place.geometry.location);
    map.setZoom(12);
    console.log(place.address_components);

    if (1*place.address_components[\"3\"].long_name > 0){
        $('#race-country').val(place.address_components[\"2\"].long_name);
        $('#race-region').val(place.address_components[\"1\"].short_name);
        $('#race-place').val(place.address_components[\"0\"].short_name);
    } else {
        $('#race-country').val(place.address_components[\"3\"].long_name);
        $('#race-region').val(place.address_components[\"2\"].short_name);
        $('#race-place').val(place.address_components[\"0\"].short_name);
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
?>

<div class="race-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>

    <?= $form->field($model, 'coord_lat')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'coord_lon')->hiddenInput()->label(false); ?>

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



    <?= $form->field($model, 'author_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => \user\models\User::getAuthorData(),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите пользователя'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

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

    <?= $form->field($model, 'start_time')->hiddenInput() ?>

    <div class="form-group field-race-start_time_picker">
        <input type="text" id="race-start_time_hours" class="form-control timepicker" value="<?= $hours ?>">
        <label for="race-start_time_hours" class="timepicker">часов</label>
        <input type="text" id="race-start_time_minutes" class="form-control timepicker" value="<?= $minutes ?>">
        <label for="race-start_time_minutes" class="timepicker">минут</label>
    </div>

    <input id="autocomplete" class="form-control google-input" onFocus="geolocate()" type="text" placeholder="Начните вводить адрес..">
    <div id="googleMap" style="width:1000px;height:435px;"></div>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <?= $form->field($model, 'label_en')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>

    <?= $form->field($model, 'sport_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\sport\models\Sport::find()->all(), 'id', 'label')
    ) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'currency')->dropDownList(
        ['рубли' => 'Рубли', 'доллары' => 'Доллары', 'евро' => 'Евро',],
        ['class' => 'w130 form-control',]
    ) ?>

    <?= $form->field($model, 'currency_en')->dropDownList(
        ['рубли' => 'RUR', 'доллары' => 'USD', 'евро' => 'EUR',],
        ['class' => 'w130 form-control',]
    ) ?>

    <?= $form->field($model, 'organizer_id')->dropDownList(\yii\helpers\ArrayHelper::map(\organizer\models\Organizer::find()->all(), 'id', 'label')) ?>

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

    <?= $form->field($model, 'promo')->widget(
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

    <?= $form->field($model, 'promo_en')->widget(
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

    <?= $form->field($model, 'content_en')->widget(
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

    <?= $form->field($model, 'instagram_tag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facebook_event_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'published')->checkbox([], false)->label(false) ?>

    <label for="race-published" class="published-label">Опубликовано</label>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
