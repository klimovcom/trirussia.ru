<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel sport\models\SportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Виды спорта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sport-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать вид спорта', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\Column'],

            'id',
            'label',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
