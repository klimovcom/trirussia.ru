<?php
use yii\helpers\Html;
use metalguardian\fileProcessor\helpers\FPM;
?>
<div class="container">
    <h1 class="m-t-3 m-b-3">Sapik Team</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card card-block">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="card m-b-0">
                            <div class="training-card">
                                <div class="card-img-top card--generated-bg coach-item--bg" data-label="<?= $model->label;?>"></div>
                            </div>
                            <?= Html::img(FPM::originalSrc($model->image_id), ['class' => 'avatar']);?>
                            <div class="card-block">
                                <h4 class="text-xs-center"><?= $model->label;?></h4>
                                <div class="text-xs-center m-b-1">
                                    <?= $model->promo;?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <h5>Специализация</h5>
                        <ul class="list-unstyled">
                            <?php foreach ($model->sports as $sport) {
                                echo Html::tag('li', $sport->label);
                            }
                            ?>
                        </ul>
                        <hr>
                        <h5>Стоимость</h5>
                        <div>
                            <?= $model->price;?>
                        </div>
                        <hr>
                        <h5>Контактная информация</h5>
                        <ul class="list-unstyled">
                            <?php
                            $contacts = [
                                'site',
                                'fb_link',
                                'vk_link',
                                'ig_link'
                            ];
                            foreach ($contacts as $contact) {
                                if ($model->$contact) {
                                    echo Html::tag('li', Html::a($model->$contact, $model->$contact, ['class' => 'underline', 'target' => '_blank']));
                                }
                            }

                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2 class="m-t-2 m-b-2">Другие тренеры</h2>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card-columns">
                <?php foreach($otherCoaches as $coach):?>
                    <div class="card card-block">
                        <h4 class="card-title">
                            <?= Html::a($coach->label, ['/coach/default/view', 'url' => $coach->url], ['class' => 'underline']);?>
                        </h4>
                        <div>
                            <?= $coach->promo;?>
                        </div>
                        <hr>
                        <ul class="list-inline text-xs-center m-b-0">
                            <?php foreach ($coach->sports as $sport) {
                                echo Html::tag('li', Html::img(FPM::originalSrc($sport->icon_id)), ['class' => 'list-inline-item m-l-1 m-r-1']);
                            }
                            ?>
                        </ul>
                    </div>
                <?php endforeach;?>

                <div class="card card-block">
                    <h4>Добавить в справочник</h4>
                    <p>Если по какой-то причине вас или вашей компании нет в справочнике, это можно легко исправить. Просто напишите о себе на электронную почту <a href="mailto:artem@klimov.com" class="underline">artem@klimov.com</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>