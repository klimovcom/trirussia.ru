<?php
use yii\helpers\Html;
use race\models\RaceDistanceRef;
?>
<div class="form-group" id="race-distance-list-item-<?=$counter;?>">
    <div id="race-distance-list-item-row-<?=$counter;?>" class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="race-distance-list-item-distance-<?=$counter;?>">Дистанция</label>
            <?= Html::dropDownList($raceDistance->formName() . '[' . $counter . '][distance_id]', $raceDistance->distance_id, $distanceForSportArray, [
                'id' => 'race-distance-list-item-distance-' . $counter,
                'class' => 'form-control'
            ]);?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="race-distance-list-item-type-<?=$counter;?>">Тип гонки</label>
            <?= Html::dropDownList($raceDistance->formName() . '[' . $counter . '][type]', $raceDistance->type, RaceDistanceRef::getTypeArray(), [
                'id' => 'race-distance-list-item-type-' . $counter,
                'class' => 'form-control race-distance-type', 'data-block' => $counter
            ]);?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="race-distance-list-item-price-<?=$counter;?>">Стоимость</label>
            <?= Html::textInput($raceDistance->formName() . '[' . $counter . '][price]', $raceDistance->price, [
                'id' => 'race-distance-list-item-price-' . $counter,
                'class' => 'form-control'
            ])?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">&nbsp;</label>
            <?= Html::button('Удалить', ['class' => 'btn btn-block btn-danger race-distance-list-btn-delete', 'data-id' => $counter]);?>
            </div>
        </div>
    </div>
    <?php if ($raceDistance->relay) {
        echo $this->render('distance_relay_wrap', [
            'models' => $raceDistance->relay,
            'distance_counter' => $counter,
        ]);
    }?>
    <hr>
</div>
