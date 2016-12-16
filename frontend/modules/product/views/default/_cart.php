<?php
use yii\helpers\Html;
?>
<div class="cart-container">
    <div class="container">
        Товаров: <span id="product_cart_count"><?= Yii::$app->cart->getCount();?></span> на <span id="product_cart_cost"><?= Yii::$app->cart->getCost();?></span> ₽ <?= Html::a('Перейти в корзину', ['cart'], ['class' => 'm-l-1 btn btn-secondary btn-sm']);?>
    </div>
</div>
