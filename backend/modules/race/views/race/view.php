<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model race\models\Race */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Races', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created',
            'author_id',
            'start_date',
            'finish_date',
            'start_time',
            'country',
            'region',
            'place',
            'label',
            'url:url',
            'price',
            'currency',
            'organizer_id',
            'site',
            [
                'attribute' => 'main_image_id',
                'format' => 'raw',
                'value' => $model->main_image_id
                    ? Html::img(
                        \metalguardian\fileProcessor\helpers\FPM::originalSrc($model->main_image_id)
                    )
                    : null,
            ],
            'promo:ntext',
            'content:ntext',
            'instagram_tag',
            'facebook_event_id',
            'published',
        ],
    ]) ?>

</div>
