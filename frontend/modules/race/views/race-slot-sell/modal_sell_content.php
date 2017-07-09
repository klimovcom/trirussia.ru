<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use race\models\Race;

?>

<div class="modal-body">
    <p>Если у вас есть слот на соревнование, но вы не можете участвовать, то предложите его тем, кто его ищет.</p>
    <fieldset class="form-group">
        <label>Выберите старт</label>
        <?= Html::dropDownList('race_id', null, ArrayHelper::map(Race::find()->where(['>=', 'start_date', date('Y-m-d', time())])->published()->all(), 'id', 'label'), ['id' => 'race-slot-sell-modal-race_id', 'class' => 'c-select', 'prompt' => 'Выберите дистанцию']);?>
    </fieldset>
    <fieldset class="form-group">
        <label>Выберите дистанцию</label>
        <?= Html::dropDownList('distance_id', null, [], ['id' => 'race-slot-sell-modal-distance_id', 'class' => 'c-select']);?>
    </fieldset>
    <div class="row">
        <div class="col-xl-6">
            <fieldset class="form-group">
                <label>Укажите вашу цену</label>
                <input id="race-slot-sell-modal-price" class="form-control col-xl-6" maxlength="255" type="text">
            </fieldset>
        </div>
    </div>
    <?= Html::a('Добавить', 'javascript:;', ['class' => 'btn btn-primary m-t-1 btn-race-slot-sell-modal-create', 'data-type' => $type]);?>
</div>
