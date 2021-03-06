<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model camp\models\Camp */

$this->title = 'Создать кэмп';
$this->params['breadcrumbs'][] = ['label' => 'Кэмпы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header camp-create">
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
<section class="content camp-create">
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
