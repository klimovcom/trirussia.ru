<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model post\models\Post */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Публикации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content-header post-view">
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
<section class="content post-view">
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
                            'label',
                            'url:url',
                            'promo:ntext',
                            'content:ntext',
                            [
                                'attribute' => 'image_id',
                                'format' => 'raw',
                                'value' => $model->image_id
                                    ? Html::img(
                                        \metalguardian\fileProcessor\helpers\FPM::originalSrc($model->image_id)
                                    )
                                    : null,
                            ],
                            [
                                'attribute' => 'type',
                                'format' => 'raw',
                                'value' => $model->getType(),
                            ],
                            'tags',
                            'popularity',
                            'published',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>
