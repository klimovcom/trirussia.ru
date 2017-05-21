<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use camp\models\Camp;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use organizer\models\Organizer;

/* @var $this yii\web\View */
/* @var $model camp\models\Camp */
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
        $(\"#camp-coord_lat\").val(latitude);

        var longitude = event.latLng.lng();
        $(\"#camp-coord_lon\").val(longitude);

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
    $('#camp-coord_lat').val(place.geometry.location.lat());
    $('#camp-coord_lon').val(place.geometry.location.lng());
    for(var i = 0; i < place.address_components.length; i++){
        console.log(place.address_components[i].types);
        if (place.address_components[i].types.indexOf('political') != -1){
            if (place.address_components[i].types.indexOf('country') != -1){
                console.log('here we are 1');
                $('#camp-country').val(place.address_components[i].long_name);
            }
            if (place.address_components[i].types.indexOf('locality') != -1){
                console.log('here we are 2');
                $('#camp-region').val(place.address_components[i].short_name);
            }
        }
        if (place.address_components[i].types.indexOf('point_of_interest') != -1
            && place.address_components[i].types.indexOf('establishment') != -1){
                console.log('here we are 3');
                $('#camp-place').val(place.address_components[i].short_name);
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
?>

<div class="camp-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <div class="box-body">
        <?= $form->field($model, 'coord_lat')->hiddenInput()->label(false); ?>

        <?= $form->field($model, 'coord_lon')->hiddenInput()->label(false); ?>

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
                <?= $form->field($model, 'date_start')->widget(\kartik\date\DatePicker::className(), [
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
                <?= $form->field($model, 'date_end')->widget(\kartik\date\DatePicker::className(), [
                    'name' => 'check_issue_date',
                    'value' => date('d-M-Y', strtotime('+5 days')),
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
                <?= $form->field($model, 'max_user_count')->textInput() ?>

            </div>
        </div>

        <?= $form->field($model, 'sportArray')->widget(\kartik\select2\Select2::className(), [
            'attribute' => 'sportArray',
            'model' => $model,
            'data' => \yii\helpers\ArrayHelper::map(\sport\models\Sport::find()->all(), 'id', 'label'),
            'value' => \yii\helpers\ArrayHelper::getColumn($model->sports, 'id'),
            'options' => [ 'placeholder' => 'Выберите виды спорта', 'multiple' => true, ],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]); ?>

        <?= $form->field($model, 'promo')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'description')->widget(
            \vova07\imperavi\Widget::className(),
            [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 200,
                    'plugins' => [
                        'clips',
                        'fullscreen'
                    ],
                    'imageUpload' => Url::to(['image-upload']),
                ]
            ]
        )->label(); ?>

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
        <?= $form->field($model, 'image_id')->fileInput() ?>

        <div class="form-group">
            <?php
            echo '<label class="control-label">Организатор</label>';
            echo Select2::widget([
                'name' => $model->formName() . '[organizer_label]',
                'value' => $model->organizer ? $model->organizer->label : '',
                'data' => ArrayHelper::map(Organizer::find()->orderBy(['label' => SORT_ASC])->all(), 'label', 'label'),
                'theme' => Select2::THEME_KRAJEE,
                'options' => ['placeholder' => '-- Выберите организатора --'],
                'pluginOptions' => [
                    'tags' => true,
                    'tokenSeparators' => [',', ' '],
                    'maximumInputLength' => 255
                ],
            ]);
            ?>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'price')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'currency')->dropDownList(
                    Camp::getCurrencyArray(),
                    ['class' => 'w130 form-control',]
                ) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'is_accommodation')->checkbox() ?>
            </div>
            <div class="col-md-6">

            </div>
        </div>

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

    <?php ActiveForm::end(); ?>

</div>
