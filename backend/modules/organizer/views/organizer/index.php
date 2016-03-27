<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel organizer\models\OrganizerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Организаторы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать организатора', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\Column'],

            'id',

            'label',
            'country',
            'site',
            'phone',
            'email:email',
            // 'image_id',
            // 'promo:ntext',
            // 'content:ntext',
            [
                'attribute' => 'published',
                'value' => function ($model) {
                    /** @var $model \organizer\models\Organizer */
                    return $model->published ? 'Да' : 'Нет';
                },
                'filter' => [0 => 'Нет', 1 => 'Да']
            ],
            'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
