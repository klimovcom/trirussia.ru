<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model product\models\Product */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$images = '';
if (count($model->productImages)) {
    $images .= Html::beginTag('div', ['class' => 'row']);
    foreach ($model->productImages as $image) {
        $images .= Html::beginTag('div', ['class' => 'col-xs-4']);
        $images .= Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($image->image_id), ['class' => 'img-responsive form-control-with-margin']);
        $images .= Html::endTag('div');
    }
    $images .= Html::endTag('div');
}
?>

<section class="content-header product-view">
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
<section class="content product-view">
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
                            'created',
                            'label',
                            'url',
                            'promo:ntext',
                            'content:ntext',
                            [
                                'attribute' => 'images',
                                'format' => 'raw',
                                'value' => $images,
                            ],
                            'price',
                            [
                                'attribute' => 'category_id',
                                'format' => 'raw',
                                'value' => $model->category->label,
                            ],
                            [
                                'attribute' => 'published',
                                'format' => 'raw',
                                'value' => $model->published ? 'Да' : 'Нет',
                            ]
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>