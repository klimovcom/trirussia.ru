<?php
use yii\helpers\Html;

$classSuffix = '-' . $group . '-' . $position;

echo Html::a('Беру этап', 'javascript:;', [
    'class' => 'btn btn-sm btn-primary-outline btn-race-relay-modal-show-time btn-race-relay-modal-show-time' . $classSuffix,
    'data-group' => $group,
    'data-position' => $position,
]);
echo Html::beginTag('div', ['class' => 'hidden race-relay-modal-form race-relay-modal-form' . $classSuffix]);

echo Html::beginTag('fieldset', ['class' => 'form-group m-b-0']);
echo Html::label('Ваше время', 'race-relay-modal-time' . $classSuffix, ['class' => 'small']);
echo Html::textInput('', null, [
    'id' => 'race-relay-modal-time' . $classSuffix,
    'class' => 'form-control',
]);
echo Html::endTag('fieldset');

echo Html::a('Сохранить', 'javascript:;', [
    'class' => 'small dotted btn-race-relay-modal-register',
    'data-race-id' => $race_id,
    'data-distance-id' => $distance_id,
    'data-position' => $position,
    'data-group' => $group
]);
echo Html::endTag('div');