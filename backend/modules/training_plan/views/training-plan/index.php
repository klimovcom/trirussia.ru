<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel training_plan\models\TrainingPlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тренировочные планы';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header training-plan-index">
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
<section class="content training-plan-index">
    <p><a href="<?= \yii\helpers\Url::to('create'); ?>" class="btn btn-primary">Добавить тренировочный план</a></p>
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
                            ['class' => 'yii\grid\SerialColumn'],

                            //'id',
                            'label',
                            'url:url',
                            'level',
                            'count',
                            // 'amount',
                            // 'progress',
                            // 'author_id',
                            // 'author_name',
                            // 'format',
                            // 'price',
                            // 'duration',
                            // 'sport',
                            // 'popularity',
                            // 'info:ntext',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>