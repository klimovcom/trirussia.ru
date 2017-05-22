<?php
use yii\helpers\Html;
?>
<div id="race-distance-relay-wrap-<?= $distance_counter;?>">
    <div id="race-distance-relay-block-<?= $distance_counter;?>" class="row">
        <?php
        $relay_counter = 0;
        foreach ($models as $model) {
            echo $this->render('distance_relay_stage', [
                'model' => $model,
                'distance_counter' => $distance_counter,
                'relay_counter' => $relay_counter,
            ]);
            $relay_counter++;
        }
        ?>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <a href="javascript:;" class="btn btn-success btn-race-distance-relay-add" data-distance_counter="<?= $distance_counter;?>" data-relay_counter="<?= $relay_counter;?>">Добавить этап</a>
        </div>
    </div>

</div>