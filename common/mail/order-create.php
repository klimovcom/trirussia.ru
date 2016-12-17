<?php
$result = 'Здравствуйте! Вы создали заказ №' . $model->label . ' стоимостью ' . $model->cost . ' р. на сайте www.trirussia.ru.' . "\r\n";
$result .= 'Оплатить заказ можно по ссылке www.trirussia.ru/shop/payment/' .$model->label . "\r\n";
$result .= 'Состав заказа:' . "\r\n";
foreach ($model->productOrderProductOrderItems as $item) {
    $result .= $item->productOrderItem->product->label . ' - кол-во: ' . $item->quantity;
    if (count(unserialize($item->productOrderItem->info))) {
        $result .= ', характеристики: ';
        foreach (unserialize($item->productOrderItem->info) as $value) {
            $result .= $value['attr'] . ' - ' . $value['value'] . ', ';
        }
    }
    $result .= "\r\n";
}
echo $result;