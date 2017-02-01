<?php
use yii\helpers\Html;
?>

<div class="container">
    <h1 class="m-t-3 m-b-3">Организаторы соревнований по триатлону, бегу, плаванию и велоспорту</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card-columns">
                <?php
                foreach ($organizers as $org) {
                    echo Html::beginTag('div', ['class' => 'card card-block']);
                    echo Html::tag('h4',
                        Html::a($org->label, ['/site/search-races', 'organizer' => $org->label], ['class' => 'underline']),
                        ['class' => 'card-title']);
                    echo Html::tag('div', $org->promo, ['class' => 'm-b-1']);
                    Yii::info($org->image_id);
                    echo Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($org->image_id), ['class' => 'card-organizer-logo']);
                    echo Html::endTag('div');
                }
                ?>
            </div>
        </div>
    </div>
</div>