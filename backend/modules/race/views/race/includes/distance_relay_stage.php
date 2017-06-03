<?php
use yii\helpers\Html;
use race\models\RaceRelay;

$distance_formname = 'RaceDistanceRef[' . $distance_counter .'][relay][' . $relay_counter .']';
?>
<div id="race-distance-relay-block-item-<?= $relay_counter;?>" class="col-xs-3">
    <div class="form-group">
        <div class="control-label">Спорт</div>
        <?= Html::dropDownList($distance_formname . '[sport]', $model->sport, RaceRelay::getSportArray(), ['class' => 'form-control']);?>
    </div>
    <div class="form-group">
        <div class="control-label">Дистанция (м)</div>
        <?= Html::input('text', $distance_formname . '[distance]', $model->distance, ['class' => 'form-control']);?>
    </div>
    <div class="form-group">
        <a href="javascript:;" class="btn btn-danger btn-race-distance-relay-delete" data-relay="<?= $relay_counter;?>">Удалить</a>
    </div>
</div>
