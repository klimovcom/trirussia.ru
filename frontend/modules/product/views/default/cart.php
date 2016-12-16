<?php
use yii\helpers\Html;
use metalguardian\fileProcessor\helpers\FPM;
?>
<div class="container">
    <div class="row m-t-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card card-block">
                <?php if (count($orderItems)):?>
                    <h1 class="text-xs-center m-t-2 m-b-3">Проверьте ваш заказ</h1>
                    <hr>
                    <?php foreach($orderItems as $item):?>
                        <?php
                        ?>
                        <div class="row" id="cart_order_item_<?= $item->id;?>">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                <?= Html::img(FPM::originalSrc($item->product->productImages[0]->image_id), ['class' => 'img-fluid']);?>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <?= Html::tag('h5', $item->product->label);?>
                                <?php
                                $info = unserialize($item->info);
                                if (is_array($info)) {
                                    echo Html::beginTag('ul', ['class' => 'list-unstyled']);
                                    foreach ($info as $attr) {
                                        echo Html::tag('li', $attr['attr'] . ': ' . $attr['value']);
                                    }
                                    echo Html::endTag('ul');
                                }
                                ?>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                <p>
                                    <a href="javascript:;" onclick="ChangeCartPositionCount(<?= $item->id ;?>, -1)"><i class="fa fa-minus-circle m-r-1 text-muted" aria-hidden="true"></i></a><span id="cart_order_item_quantity_<?= $item->id ;?>"><?= $item->getQuantity();?></span> шт.<a href="javascript:;" onclick="ChangeCartPositionCount(<?= $item->id ;?>, 1)"><i class="fa fa-plus-circle m-l-1 text-muted" aria-hidden="true"></i></a>
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                <div class="pull-left">
                                    <p><strong><span id="cart_order_item_cost_<?= $item->id;?>"><?= $item->getCost();?></span> ₽</strong></p>
                                </div>
                                <div class="pull-right">
                                    <p><a href="javascript:;" class="no-underline" onclick="RemoveFromCart(<?= $item->id;?>)"><i class="fa fa-times-circle" aria-hidden="true"></i></a></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach;?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-xs-right">
                            <span class="m-r-2"><strong>Итого: <span id="cart_total"><?= Yii::$app->cart->getCost();?></span> ₽</strong></span><?= Html::a('Далее: выбрать адрес доставки', ['/product/default/delivery'], ['class' => 'btn btn-danger btn-lg']);?>
                        </div>
                    </div>
                <?php else: ?>
                    <h1 class="text-xs-center m-t-2 m-b-3">Корзина пуста</h1>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
