<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel sport\models\SportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Виды спорта';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header sport-index">
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
<section class="content  sport-index">
    <p><a href="<?= \yii\helpers\Url::to('/sport/sport/create'); ?>" class="btn btn-primary">Добавить вид спорта</a></p>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <?= GridView::widget([
                        'tableOptions' => ['class' => 'table table-striped table-bordered dataTable no-footer table',],
                        'layout'=>"{items}\n{summary}\n{pager}",
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            'id',
                            'label',
                            'url',
                            [
                                'attribute' => 'is_on_main',
                                'value' => function ($model) {
                                    return $model->is_on_main ? 'Да' : 'Нет';
                                },
                                'filter' => [0 => 'Нет', 1 => 'Да']
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>