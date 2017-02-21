<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel coach\models\CoachSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тренеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header coach-index">
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
<section class="content  coach-index">
    <p><a href="<?= \yii\helpers\Url::to('/coach/coach/create'); ?>" class="btn btn-primary">Добавить тренера</a></p>
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
                            'site',
                            [
                                'attribute' => 'published',
                                'value' => function($model) {
                                    return $model->published ? 'Да' : 'Нет';
                                },
                                'filter' => [0 => 'Нет', 1 => 'Да']
                            ],
                            [
                                'attribute' => 'is_on_moderation',
                                'value' => function($model) {
                                    return $model->is_on_moderation ? 'Да' : 'Нет';
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