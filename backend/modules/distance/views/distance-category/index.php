<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel distance\models\DistanceCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории дистанций';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header distance-category-index">
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
<section class="content  distance-category-index">
    <p><a href="<?= \yii\helpers\Url::to('/distance/distance-category/create'); ?>" class="btn btn-primary">Добавить категорию дистанций</a></p>
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

                            'sport_id' => [
                                'attribute' => 'sport_id',
                                'value' => function ($model) {
                                    $sport = \sport\models\Sport::findOne($model->sport_id);
                                    if ($sport)
                                        return $sport->label;
                                    return null;
                                },
                                'filter' => \yii\helpers\ArrayHelper::map(\sport\models\Sport::find()->all(), 'id', 'label'),
                            ],
                            'label',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>