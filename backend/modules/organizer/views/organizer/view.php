<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model organizer\models\Organizer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Organizers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizer-view">

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
            'label',
            'country',
            'site',
            'phone',
            'email:email',
            [
                'attribute' => 'image_id',
                'format' => 'raw',
                'value' => $model->image_id
                    ? Html::img(
                        \metalguardian\fileProcessor\helpers\FPM::originalSrc($model->image_id)
                    )
                    : null,
            ],
            'promo:ntext',
            'content:ntext',
            'published',
        ],
    ]) ?>

</div>
