<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel organizer\models\OrganizerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Организаторы';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header organizer-index">
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
<section class="content  organizer-index">
    <p><a href="<?= \yii\helpers\Url::to('/organizer/organizer/create'); ?>" class="btn btn-primary">Добавить организатора</a></p>
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
                            [
                                'attribute' => 'label',
                                'format' => 'raw',
                                'value' => function($model){
                                    $label = !empty($model->label) ? $model->label : '(не задано)';
                                    return Html::a($label, \yii\helpers\Url::to('/organizer/organizer/view/' . $model->id));
                                }
                            ],
                            'country',
                            [
                                'attribute' => 'site',
                                'format' => 'raw',
                                'value' => function($model){
                                    $label = !empty($model->site) ? $model->site : '(не задано)';
                                    return Html::a($label, \yii\helpers\Url::to($model->site));
                                }
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>