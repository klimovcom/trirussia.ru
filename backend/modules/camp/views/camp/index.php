<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel camp\models\CampSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Кэмпы';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header race-index">
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
<section class="content camp-index">
    <p><a href="<?= \yii\helpers\Url::to('create'); ?>" class="btn btn-primary">Добавить кэмп</a></p>
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
                            'url:url',
                            //'country',
                            //'region',
                            // 'place',
                            // 'coord_lon',
                            // 'coord_lat',
                            // 'date_start',
                            // 'date_end',
                            'max_user_count',
                            // 'promo:ntext',
                            // 'description:ntext',
                            // 'image_id',
                            'price',
                            // 'currency',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>