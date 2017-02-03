<?php
use yii\helpers\Html;
?>
<div class="container">
    <h1 class="m-t-3 m-b-3">Специальные условия, скидки и промокоды только для пользователей TriRussia.ru</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="row">
                <ul class="flex-container">
                    <?php foreach ($models as $promocode):?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <li class="flex-item">
                                <div class="card card-block">
                                    <h4 class="card-title">
                                        <?= Html::a($promocode->label, $promocode->url, ['class' => 'underline-black']);?>
                                    </h4>
                                    <div class="card-text m-b-1">
                                        <?= $promocode->promo;?>
                                    </div>
                                    <hr>
                                    <h6 class="partner-shop-caption tri text-xs-center">Специальные условия</h6>
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3 col-xl-3">
                                            <h1 class="discount"><?= $promocode->discount;?>%</h1>
                                        </div>
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-9 col-xl-9">
                                            <div class="small m-b-0">
                                                <?= $promocode->conditions;?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="promocode-item--promocode  m-t-1">
                                        <button class="btn btn-secondary btn-block promocode-item--promocode--button">Получить промокод</button>
                                        <span class="hidden promocode-item--promocode--text"><?= $promocode->promocode;?></span>
                                    </div>
                                </div>
                            </li>
                        </div>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</div>