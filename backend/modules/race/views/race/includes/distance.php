<?php
use yii\helpers\Html;
use race\models\RaceDistanceRef;
?>
<div class="form-group" id="race-distance-list-item-<?=$counter;?>">
    <div class="row form-group">
        <div class="col-md-5">
            <?= Html::dropDownList($raceDistance->formName() . '[' . $counter . '][distance_id]', $raceDistance->distance_id, $distanceForSportArray, ['class' => 'form-control']);?>
        </div>
        <div class="col-md-3">
            <?= Html::dropDownList($raceDistance->formName() . '[' . $counter . '][type]', $raceDistance->type, RaceDistanceRef::getTypeArray(), ['class' => 'form-control race-distance-type', 'data-block' => $counter]);?>
        </div>
        <div class="col-md-3">
            <?= Html::textInput($raceDistance->formName() . '[' . $counter . '][price]', $raceDistance->price, ['class' => 'form-control'])?>
        </div>
        <div class="col-md-1">
            <?= Html::button('-', ['class' => 'btn btn-block btn-danger race-distance-list-btn-delete', 'data-id' => $counter]);?>
        </div>
    </div>
    <?php if ($raceDistance->relay) {
        echo $this->render('distance_relay_wrap', [
            'models' => $raceDistance->relay,
            'distance_counter' => $counter,
        ]);
    }?>
</div>