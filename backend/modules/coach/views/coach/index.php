<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel coach\models\CoachSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Coaches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coach-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать тренера', ['create'], ['class' => 'btn btn-success']) ?>
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
            'created',


            // 'fb_link',
            // 'vk_link',
            // 'ig_link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
