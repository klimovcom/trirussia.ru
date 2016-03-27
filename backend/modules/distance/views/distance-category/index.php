<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel distance\models\DistanceCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории дистанций';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distance-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать категорию дистанций', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'label',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
