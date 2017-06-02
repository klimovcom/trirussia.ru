<?php
use yii\helpers\Html;

echo Html::tag('p', $registration->time, ['class' => 'm-b-0']);
echo Html::tag('span', $registration->user->last_name . ' ' . $registration->user->first_name, ['class' => 'small']);
if (Yii::$app->user->id === $registration->user_id || Yii::$app->user->id === $first_user_id) {
    echo ' ' . Html::a(Html::tag('i', '', ['class' => 'fa fa-times', 'style' => 'color: #cc0000;']), 'javascript:;', [
            'class' => 'btn-race-relay-modal-unregister',
            'data-race-id' => $registration->race_id,
            'data-distance-id' => $registration->distance_id,
            'data-group' => $registration->group,
            'data-position' => $registration->position,
        ]);
}