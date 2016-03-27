<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel post\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Публикации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать публикацию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\Column'],

            'id',
            'author_id',
            'label',
            'url',
            // 'promo:ntext',
            // 'content:ntext',
            // 'image_id',
            [
                'attribute' => 'published',
                'value' => function ($model) {
                    return $model->published ? 'Да' : 'Нет';
                },
                'filter' => [0 => 'Нет', 1 => 'Да']
            ],
            'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
