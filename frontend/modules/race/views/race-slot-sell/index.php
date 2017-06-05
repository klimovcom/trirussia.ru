<?php
use yii\helpers\Html;
use race\models\RaceSlotSell;
use yii\helpers\ArrayHelper;
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="card card-block">
                <h3 class="m-b-2">Продажа слотов</h3>
                <?php
                $sellOffers = ArrayHelper::getValue($offers, RaceSlotSell::TYPE_SELL);
                if (!is_array($sellOffers)) {
                    $sellOffers = [];
                }
                $sellOffers = ArrayHelper::index($sellOffers, null, 'race_id');
                echo Html::beginTag('ul', ['id' => 'race-slot-sell-list-' .  RaceSlotSell::TYPE_SELL, 'class' => 'list-unstyled m-b-0']);
                if (is_array($sellOffers)) {
                    foreach ($sellOffers as $race_id => $slotsByRace) {
                        $race = $races[$race_id];

                        $slotByDistance = ArrayHelper::index($slotsByRace, null, 'distance_id');
                        foreach ($slotByDistance as $distance_id => $slots) {
                            $distance = $distances[$distance_id];

                            echo $this->render('_list_item', [
                                'race' => $race,
                                'distance' => $distance,
                                'slots' => $slots,
                                'type' => RaceSlotSell::TYPE_SELL,
                            ]);
                        }
                    }
                }
                echo Html::endTag('ul');
                ?>
                <?php
                if (Yii::$app->user->id) {
                    echo Html::a('Добавить слот на продажу', 'javascript:;', ['class' => 'btn btn-secondary m-t-2 btn-race-slot-sell-add', 'data-type' => RaceSlotSell::TYPE_SELL]);
                }else {
                    echo Html::a('Добавить слот на продажу', 'javascript:;', ['class' => 'btn btn-secondary m-t-2', 'data-toggle' => 'modal', 'data-target' => '#openUser']);
                }
                ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="card card-block">
                <h3 class="m-b-2">Покупка слотов</h3>
                <?php
                $sellOffers = ArrayHelper::getValue($offers, RaceSlotSell::TYPE_BUY);
                if (!is_array($sellOffers)) {
                    $sellOffers = [];
                }
                $sellOffers = ArrayHelper::index($sellOffers, null, 'race_id');
                echo Html::beginTag('ul', ['id' => 'race-slot-sell-list-' .  RaceSlotSell::TYPE_BUY, 'class' => 'list-unstyled m-b-0']);
                if (is_array($sellOffers)) {
                    foreach ($sellOffers as $race_id => $slotsByRace) {
                        $race = $races[$race_id];

                        $slotByDistance = ArrayHelper::index($slotsByRace, null, 'distance_id');
                        foreach ($slotByDistance as $distance_id => $slots) {
                            $distance = $distances[$distance_id];

                            echo $this->render('_list_item', [
                                'race' => $race,
                                'distance' => $distance,
                                'slots' => $slots,
                                'type' => RaceSlotSell::TYPE_BUY,
                            ]);
                        }
                    }
                }
                echo Html::endTag('ul');
                ?>
                <?php
                if (Yii::$app->user->id) {
                    echo Html::a('Добавить заявку на покупку слота', 'javascript:;', ['class' => 'btn btn-secondary m-t-2 btn-race-slot-sell-add', 'data-type' => RaceSlotSell::TYPE_BUY]);
                }else {
                    echo Html::a('Добавить заявку на покупку слота', 'javascript:;', ['class' => 'btn btn-secondary m-t-2', 'data-toggle' => 'modal', 'data-target' => '#openUser']);
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="race-slot-sell-modal" role="dialog" aria-labelledby="race-slot-sell-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>

                <h4 class="modal-title" id="race-slot-sell-label"></h4>
            </div>
            <div id="race-slot-sell-content" class="modal-body">

            </div>
        </div>
    </div>
</div>