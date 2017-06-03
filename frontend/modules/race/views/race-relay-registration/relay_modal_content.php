<?php
use race\models\RaceRelay;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>

<div id="race-relay-modal-alert" class="alert alert-danger hidden" role="alert">
    <button id="race-relay-modal-alert-close" type="button" class="close" >
        <span aria-hidden="true">&times;</span>
    </button>
    <span id="race-relay-modal-alert-content"></span>
</div>

<h5 class="text-xs-center m-b-3">Выберите партнёров в эстафете <?= $race->label;?></h5>
<table class="table text-xs-center">
    <thead>
    <tr>
        <?php
        foreach ($raceRelays as $relay) {
            echo Html::beginTag('th', ['class' => 'text-xs-center']);
            echo Html::tag('h6', RaceRelay::getSportArray()[$relay->sport], ['class' => 'sport-caption m-a-0']);
            echo Html::tag('p', 'Дистанция: ' . number_format($relay->distance / 1000, 3, ',', '') . ' км.', ['class' => 'small m-b-0']);
            echo Html::endTag('th');
        }
        ?>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php
        foreach ($raceRelays as $relay) {
            echo Html::beginTag('td', ['class' => 'text-xs-center']);
            echo $this->render('includes/relay_modal_cell_form', [
                'race_id' => $relay->race_id,
                'distance_id' => $relay->distance_id,
                'position' => $relay->position,
                'group' => 0,

            ]);
            echo Html::endTag('td');
        }
        ?>
    </tr>
    <?php
    foreach ($groups as $group => $positions) {
        echo Html::beginTag('tr');

        $first_user_id = ArrayHelper::getValue(ArrayHelper::map($positions, 'is_first', 'user_id'), 1);

        foreach ($raceRelays as $relay) {
            echo Html::beginTag('td', ['class' => 'text-xs-center']);

            $registration = ArrayHelper::getValue($positions, $relay->position);
            if ($registration) {
                echo $this->render('includes/relay_modal_cell_busy', [
                    'registration' => $registration,
                    'first_user_id' => $first_user_id,
                ]);
            }else {
                echo $this->render('includes/relay_modal_cell_form', [
                    'race_id' => $relay->race_id,
                    'distance_id' => $relay->distance_id,
                    'position' => $relay->position,
                    'group' => $group,

                ]);
            }

            echo Html::endTag('td');
        }

        echo Html::endTag('tr');
    }
    ?>
    </tbody>
</table>