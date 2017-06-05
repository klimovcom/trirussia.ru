<?php
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;

?>

<div class="modal-body">
    <p>Если у вас есть слот на соревнование, но вы не можете участвовать, то предложите его тем, кто его ищет.</p>
    <fieldset class="form-group">
        <label>Выберите старт</label>
        <?php
        echo Select2::widget([
            'id' => 'race-slot-sell-modal-race_id',
            'language' => 'ru',
            'name' => 'race_id',
            'initValueText' => '',
            'options' => ['placeholder' => 'выбор гонки'],
            'pluginOptions' => [
                'allowClear' => false,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => Url::to(['/race/race-slot-sell/find-race']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(race) { return race.label; }'),
                'templateSelection' => new JsExpression('function (race) { return race.label; }'),
            ],
        ]);
        ?>
    </fieldset>
    <fieldset class="form-group">
        <label>Выберите дистанцию</label>
        <?php
        echo DepDrop::widget([
            'id' => 'race-slot-sell-modal-distance_id',
            'name' => 'distance_id',
            'type' => DepDrop::TYPE_SELECT2,
            'select2Options' => [
                'pluginOptions' => [
                    'allowClear'=>true
                ],
            ],
            'pluginOptions'=>[
                'depends' => ['race-slot-sell-modal-race_id'],
                'initialize' => true,
                'url' => Url::to(['/race/race-slot-sell/find-distance']),
                'loadingText' => 'Загрузка дистанций',
                'placeholder' => 'Выбор дистанции',
            ]
        ]);
        ?>
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
