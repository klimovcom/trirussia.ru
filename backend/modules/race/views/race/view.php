<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model race\models\Race */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Гонки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header race-view">
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
<section class="content race-view">
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
                            [
                                'attribute' => 'display_type',
                                'format' => 'raw',
                                'value' => $model->getType()
                            ],
                            'popularity',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>

