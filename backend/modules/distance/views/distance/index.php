<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel distance\models\DistanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Distances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Distance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\Column'],

            'id',
            'sport_id',
            'label',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
