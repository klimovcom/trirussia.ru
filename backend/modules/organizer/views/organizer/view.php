<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model organizer\models\Organizer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Организаторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizer-view">

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
