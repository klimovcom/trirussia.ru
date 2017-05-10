<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model organizer\models\Organizer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Организаторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header organizer-view">
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
<section class="content organizer-view">
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот объект?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Сгенерировать новый ключ', ['generate-api-key', 'id' => $model->id], ['class' => 'btn btn-danger organizer-btn-generate-token']);?>
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
                            'label',
                            'country',
                            'site',
                            'phone',
                            'email',
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
                            'api_key',
                            'published',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>
