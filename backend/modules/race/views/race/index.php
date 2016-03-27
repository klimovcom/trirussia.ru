<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel race\models\RaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Гонки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать гонку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\Column'],

            'id',
            'label',
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

            'author_id',
            'organizer_id' => [
                'attribute' => 'organizer_id',
                'value' => function ($model) {
                    $organizer = \organizer\models\Organizer::findOne($model->organizer_id);
                    if ($organizer)
                        return $organizer->label;
                    return null;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\sport\models\Sport::find()->all(), 'id', 'label'),
            ],
            'site',
            'start_date',
            [
                'attribute' => 'published',
                'value' => function ($model) {
                    /** @var $model \organizer\models\Organizer */
                    return $model->published ? 'Да' : 'Нет';
                },
                'filter' => [0 => 'Нет', 1 => 'Да']
            ],
            'created',

            // 'start_time',
            // 'country',
            // 'region',
            // 'place',

            // 'url:url',
            // 'price',
            // 'currency',


            // 'main_image_id',
            // 'promo:ntext',
            // 'content:ntext',
            // 'instagram_tag',
            // 'facebook_event_id',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
