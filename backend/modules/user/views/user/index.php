<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel user\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header user-index">
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
<section class="content  user-index">
    <p><a href="<?= \yii\helpers\Url::to(['create']); ?>" class="btn btn-primary">Добавить пользователя</a></p>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <?= GridView::widget([
                        'tableOptions' => ['class' => 'table table-striped table-bordered dataTable no-footer table',],
                        'layout'=>"{items}\n{summary}\n{pager}",
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [

                            'id',
                            [
                                'attribute' => 'first_name',
                                'format' => 'raw',
                                'value' => function($model){
                                    /** @var $model \user\models\User */
                                    $fullName = $model->first_name . ' ' . $model->last_name;
                                    if (empty($model->first_name) && empty($model->last_name))
                                        $fullName = '(не задано)';
                                    return Html::a($fullName, \yii\helpers\Url::to(['view', 'id' => $model->id]));
                                }
                            ],
                            'email',
                            'sex',
                            'age',
                            [
                                'attribute' => 'created_at',
                                'value' => function ($model) {
                                    /** @var $model \user\models\User */
                                    return date('d.m.Y', $model->created_at);
                                },
                            ],
                            [
                                'attribute' => 'fb_id',
                                'format' => 'raw',
                                'value' => function($model){
                                    $fbId = !empty($model->fb_id) ? $model->fb_id : '(не задано)';
                                    /** @var $model \user\models\User */
                                    return Html::a($fbId, \yii\helpers\Url::to('http://www.facebook.com'));
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>
