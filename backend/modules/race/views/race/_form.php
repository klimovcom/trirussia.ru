<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\Url;

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
            \"https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20160425T082450Z.90d7aff4044133c5.4d85cd55dd28eab8e83ad6dbfdfc6dcbe8f6263f&text=\" +
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
                <?= $form->field($model, 'author_id')->widget(\kartik\select2\Select2::classname(), [
                    'data' => \user\models\User::getAuthorData(),
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
                <?= $form->field($model, 'country_en')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'region_en')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'place_en')->textInput(['maxlength' => true]) ?>
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
                <?= $form->field($model, 'label_en')->textInput(['maxlength' => true, 'class' => 'form-control w850 ']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'currency')->dropDownList(
                    ['рубли' => 'Рубли', 'доллары' => 'Доллары', 'евро' => 'Евро',],
                    ['class' => 'w130 form-control',]
                ) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'currency_en')->dropDownList(
                    ['рубли' => 'RUR', 'доллары' => 'USD', 'евро' => 'EUR',],
                    ['class' => 'w130 form-control',]
                ) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'price')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'organizer_id')->dropDownList(
                    \yii\helpers\ArrayHelper::map(\organizer\models\Organizer::find()->orderBy(['label' => SORT_ASC])->all(), 'id', 'label'),
                    ['prompt' => '-- Выберите организатора --',]
                    ) ?>
            </div>
        </div>

        <?= $form->field($model, 'sport_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(\sport\models\Sport::find()->all(), 'id', 'label'),
            ['prompt' => '-- Выберите вид спорта --',]
        ) ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'distancesArray')->widget(\kartik\select2\Select2::className(), [
                    'attribute' => 'distancesArray',
                    'model' => $model,
                    'data' => $model->getDistancesData(),
                    'value' => $model->getDistancesArrayValues(),
                    'options' => [
                        'placeholder' => 'Выберите дистанции', 'multiple' => true,
                    ],
                    'pluginOptions' => [
                        'tags' => true,
                        'maximumInputLength' => 10
                    ],
                ]); ?>
            </div>
            <div class="col-md-6 categories-widget">
                <?= $form->field($model, 'categoriesArray')->widget(\kartik\select2\Select2::className(), [
                    'attribute' => 'categoriesArray',
                    'model' => $model,
                    'data' => \yii\helpers\ArrayHelper::map(
                            \distance\models\DistanceCategory::find()
                            ->where(['sport_id' => $model->sport_id, ])
                            ->all(),
                            'id',
                            'label'
                        ),
                    'value' => $model->getCategoriesArrayValues(),
                    'options' => [
                        'placeholder' => 'Выберите категории',
                        'multiple' => true,
                    ],
                    'pluginOptions' => [
                        'tags' => true,
                        'maximumInputLength' => 10
                    ],
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'special_distance')->textInput(['maxlength' => true]) ?></div>
        </div>


        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

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

        <?= $form->field($model, 'content_en')->widget(
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

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'promo')->textarea()->label(); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'promo_en')->textarea()->label(); ?>
            </div>
        </div>

        <?= $form->field($model, 'instagram_tag')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'facebook_event_id')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'popularity')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'display_type')->dropDownList(\race\models\Race::getTypes()); ?>

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

</div>
