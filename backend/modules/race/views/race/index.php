<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel race\models\RaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Races';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Race', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\Column'],

            'id',
            'created',
            'author_id',
            'start_date',
            'finish_date',
            // 'start_time',
            // 'country',
            // 'region',
            // 'place',
            // 'label',
            // 'url:url',
            // 'price',
            // 'currency',
            // 'organizer_id',
            // 'site',
            // 'main_image_id',
            // 'promo:ntext',
            // 'content:ntext',
            // 'instagram_tag',
            // 'facebook_event_id',
            // 'published',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
