<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model promo\models\Promo */

$this->title = 'Создание промо-блока';
$this->params['breadcrumbs'][] = ['label' => 'Промо-блоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header promo-create">
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
<section class="content promo-create">
    <div class="row">
        <div class="col-xs-9">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>
