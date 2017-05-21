<?php
use yii\helpers\Html;

$races = count($model->nearlyRaces) ? $model->nearlyRaces : $model->nearlyPastRaces;
?>

<div class="grid-item col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
    <div class="card card-match-height">
        <div class="card-block">
            <h4 class="card-title">
                <?= Html::a($model->label, ['/site/search-races', 'organizer' => $model->label], ['class' => 'underline-black']);?>
            </h4>
            <p class="small"><strong><?= 'Всего гонок: ' . $model->race_count;?></strong></p>
            <?php if (count($races)) {
                echo Html::beginTag('ul', ['class' => 'list-unstyled small']);
                foreach ($races as $race) {
                    echo Html::tag('li', '— ' . Html::a($race->label, ['/race/default/view', 'url' => $race->url], ['class' => 'underline']));
                }
                echo Html::endTag('ul');
            }
            ?>
            <?php if ($model->image_id):?>
                <?= Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($model->image_id), ['class' => 'card-organizer-logo']);?>
            <?php endif;?>
        </div>
    </div>
</div>