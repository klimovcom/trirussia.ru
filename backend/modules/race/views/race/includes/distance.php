<?php
use yii\helpers\Html;
use race\models\RaceDistanceRef;
?>
<div class="form-group" id="race-distance-list-item-<?=$counter;?>">
    <div class="row">
        <div class="col-md-5">
            <?= Html::dropDownList($raceDistance->formName() . '[' . $counter . '][distance_id]', $raceDistance->distance_id, $distanceForSportArray, ['class' => 'form-control']);?>
        </div>
        <div class="col-md-3">
            <?= Html::dropDownList($raceDistance->formName() . '[' . $counter . '][type]', $raceDistance->type, RaceDistanceRef::getTypeArray(), ['class' => 'form-control']);?>
        </div>
        <div class="col-md-3">
            <?= Html::textInput($raceDistance->formName() . '[' . $counter . '][price]', $raceDistance->price, ['class' => 'form-control'])?>
        </div>
        <div class="col-md-1">
            <?= Html::button('-', ['class' => 'btn btn-block btn-danger race-distance-list-btn-delete', 'data-id' => $counter]);?>
        </div>
    </div>
</div>