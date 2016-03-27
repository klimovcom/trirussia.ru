<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model race\models\Race */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Гонки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот объект?',
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
            [
                'attribute' => 'sport_id',
                'value' => \sport\models\Sport::findOne(['id' => $model->sport_id,])->label,
            ],
            'url:url',
            'price',
            'currency',
            [
                'attribute' => 'organizer_id',
                'value' => \organizer\models\Organizer::findOne(['id' => $model->organizer_id,])->label,
            ],
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
