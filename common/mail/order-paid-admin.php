<?php
$result = 'Заказ №' . $model->label . ' (http://admin.trirussia.ru/product/product-order/view?id=' . $model->id . ') стоимостью ' . $model->cost . ' р. на сайте www.trirussia.ru оплачен.' . "\r\n";
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