<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model training_plan\models\TrainingPlan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Тренировочные планы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header training-plan-view">
    <?php
    $breadcrumbs = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
    if ($breadcrumbs) {?>
        <?= \yii\widgets\Breadcrumbs::widget(
            [
                'links' => $breadcrumbs,
                'tag' => 'h1',
                'itemTemplate' => "{link}\n <span>•</span> ",
                'activeItemTemplate' => "<small>{link}</small>\n",
                'options' => ['class' => '',]
            ]
        ) ?>
    <?php } ?>
</section>
<section class="content training-plan-view">
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
    <div class="row">
        <div class="col-xs-9">
            <div class="box box-primary">
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'label',
                            'url:url',
                            'level',
                            'count',
                            'amount',
                            'progress',
                            'author_id',
                            'author_name',
                            'format',
                            'price',
                            'duration',
                            'sport_id',
                            'popularity',
                            'content:ntext',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>
