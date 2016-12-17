<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model product\models\Product */

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$orderItems = Html::beginTag('ul', ['class' => 'list-unstyled']);
foreach ($model->productOrderProductOrderItems as $item) {
    $orderItems .= Html::beginTag('li');
    $orderItems .= 'Продукт: ' . Html::a($item->productOrderItem->product->label, ['product/view', 'id' => $item->productOrderItem->product->id]) . ', кол-во ' . $item->quantity;
    $orderItems .= Html::beginTag('ul', ['class' => '']);
    foreach (unserialize($item->productOrderItem->info) as $value) {
        $orderItems .= Html::tag('li', $value['attr'] . ': ' . $value['value']);
    }
    $orderItems .= Html::endTag('ul');

    $orderItems .= Html::endTag('li');
}
$orderItems .= Html::endTag('ul');

?>

<section class="content-header product-order-view">
    <?php
    $breadcrumbs = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
    if ($breadcrumbs) {?>
        <?= \yii\widgets\Breadcrumbs::widget(
            [
                'links' => $breadcrumbs,
                'tag' => 'h1',
                'itemTemplate' => "{link}\n <span>•</span> ",
                'activeItemTemplate' => "<small>{link}</small>\n",
                'options' => ['class' => '',]
            ]
        ) ?>
    <?php } ?>
</section>
<section class="content product-order-view">
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот объект?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
        <div class="col-xs-9">
            <div class="box box-primary">
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'label',
                            'name',
                            'phone',
                            'email:email',
                            'address',
                            'date',
                            [
                                'attribute' => 'time',
                                'value' => \product\models\ProductOrder::getTimeArray()[$model->time],
                            ],
                            [
                                'attribute' => 'productOrderItems',
                                'label' => 'Состав заказа',
                                'format' => 'raw',
                                'value' => $orderItems,
                            ],
                            'cost',
                            'comment',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>