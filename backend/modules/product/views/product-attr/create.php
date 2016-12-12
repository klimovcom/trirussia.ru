<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model product\models\Product */

$this->title = 'Создание атрибута продуктов';
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты продуктов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header product-attr-create">
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
<section class="content product-attr-create">
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
