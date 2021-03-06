<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel post\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Публикации';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header post-index">
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
<section class="content post-index">
    <p><a href="<?= \yii\helpers\Url::to('/post/post/create'); ?>" class="btn btn-primary">Добавить публикацию</a></p>
    <?= \seo\widgets\SeoWidget::widget(
        [
            'model' => new \post\models\Post(),
            'form' => true,
            'style' => 'btn btn-primary btn-xs',
            'onlyForm' => true
        ]
    ) ?>
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
                            'author_id',
                            'label',
                            'url',
                            [
                                'attribute' => 'published',
                                'value' => function ($model) {
                                    return $model->published ? 'Да' : 'Нет';
                                },
                                'filter' => [0 => 'Нет', 1 => 'Да']
                            ],
                            [
                                'attribute' => 'type',
                                'value' => function ($model) {
                                    /** @var $model \post\models\Post */
                                    return $model->getType();
                                },
                                'filter' => \post\models\Post::getTypes(),
                            ],
                            [
                                'attribute' => 'featured',
                                'value' => function ($model) {
                                    /** @var $model \post\models\Post */
                                    return $model->featured ? 'Да' : 'Нет';
                                },
                                'filter' => [0 => 'Нет', 1 => 'Да']
                            ],
                            'popularity',
                            'created',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>