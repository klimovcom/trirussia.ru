<?php
use yii\helpers\Html;

if (count($slots)) {
    echo Html::beginTag('li', ['id' => 'race-slot-sell-sell-block-' . $race->id . '-' . $distance->id . '-' . $type, 'class' => 'm-b-1']);
    echo Html::tag('span', Yii::$app->formatter->asDate($race->start_date, 'd.MM.yyyy') . ' ', ['class' => 'small']);
    echo Html::a($race->label, ['/race/default/view', 'url' => $race->url], ['class' => 'underline']);
    echo ', ' . $distance->label;
    echo ' &mdash; <nobr>слотов: ' . count($slots) . '</nobr>';
    echo Html::beginTag('span', ['class' => 'text-muted small m-l-1']);
    echo 'Продают: ';
    $slotArray = [];
    foreach ($slots as $slot) {
        if (Yii::$app->user->id) {
            $deleteButton = '';
            if (Yii::$app->user->id === $slot->user_id) {
                $deleteButton = ' ' . Html::a('<i class="fa fa-times" style="color: #cc0000" aria-hidden="true"></i>', 'javascript:;', [
                        'class' => 'btn-race-slot-sell-delete',
                        'data-user_id' => $slot->user_id,
                        'data-race_id' => $slot->race_id,
                        'data-distance_id' => $slot->distance_id,
                        'data-type' => $slot->type,
                    ]);
            }

            $slotArray[] = Html::a($slot->user->last_name . ' ' . $slot->user->first_name, 'javascript:;', [
                    'class' => 'dotted btn-race-slot-sell-view',
                    'data-race_id' => $slot->race_id,
                    'data-distance_id' => $slot->distance_id,
                    'data-user_id' => $slot->user_id,
                    'data-type' => $slot->type,
                ]) . ' за ' . $slot->price . ' ' . $deleteButton;
        }else {
            $slotArray[] = Html::a($slot->user->last_name . ' ' . $slot->user->first_name, 'javascript:;', ['class' => 'dotted', 'data-toggle' => 'modal', 'data-target' => '#openUser'])  . ' за ' . $slot->price;
        }
    }
    echo implode(', ', $slotArray) . '.';
    echo Html::endTag('span');
    echo Html::endTag('li');
}