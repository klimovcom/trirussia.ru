<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel organizer\models\OrganizerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Organizers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Organizer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\Column'],

            'id',
            'created',
            'label',
            'country',
            'site',
            // 'phone',
            // 'email:email',
            // 'image_id',
            // 'promo:ntext',
            // 'content:ntext',
            // 'published',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
