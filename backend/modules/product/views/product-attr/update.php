<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model product\models\Product */

$this->title = 'Редактирование атрибута продуктов: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты продуктов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<section class="content-header product-attr-update">
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
<section class="content product-attr-update">
    <div class="row">
        <div class="col-xs-9">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $this->render('_form', [
                        'model' => $model,
                        'values' => $values,
                        'categoryArray' => $categoryArray,
                        'types' => $types,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>
