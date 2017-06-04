<?php
use yii\helpers\Html;
use race\models\RaceRelay;

$inputId = 'race-distance-list-item-' . $distance_counter . '-relay-' . $relay_counter . '-';
$distance_formname = 'RaceDistanceRef[' . $distance_counter .'][relay][' . $relay_counter .']';
?>
<div id="race-distance-relay-block-item-<?= $relay_counter;?>" class="col-xs-12">
    <div class="row">
        <div class="col-xs-3">
            <div class="form-group">
                <label class="control-label" for="<?= $inputId . 'sport';?>">Этап</label>
                <?= Html::dropDownList($distance_formname . '[sport]', $model->sport, RaceRelay::getSportArray(), [
                    'id' => $inputId . 'sport',
                    'class' => 'form-control'
                ]);?>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label class="control-label" for="<?= $inputId . 'distance';?>">Длина этапа (м)</label>
                <?= Html::input('text', $distance_formname . '[distance]', $model->distance, [
                    'id' => $inputId . 'distance',
                    'class' => 'form-control'
                ]);?>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label class="control-label">&nbsp;</label>
                <a href="javascript:;" class="btn btn-block btn-danger btn-race-distance-relay-delete" data-relay="<?= $relay_counter;?>">Удалить</a>
            </div>
        </div>
    </div>
</div>
