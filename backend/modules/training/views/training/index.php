<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel training\models\TrainingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тренировки';
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
    <p><a href="<?= \yii\helpers\Url::to('create'); ?>" class="btn btn-primary">Добавить тренировку</a></p>
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

                            'id',
                            'label',
                            'date',
                            'time',
                            'place_id',
                            // 'sport_id',
                            // 'level',
                            // 'price',
                            // 'currency',
                            // 'trainer_name',
                            // 'phone',
                            // 'email:email',
                            // 'promo:ntext',
                            // 'author_id',
                            // 'published',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>