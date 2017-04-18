<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel race\models\RaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Зарегистрированные пользователи на гонку: ' . $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Гонки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header race-index">
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
<section class="content  race-index">
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
                            ['class' => 'yii\grid\SerialColumn'],
                            //'user_id',
                            'first_name',
                            'last_name',
                            [
                                'attribute' => 'gender',
                                'format' => 'raw',
                                'value' => function($model){
                                    return \common\models\UserInfo::getGenderArray()[$model->gender];
                                }
                            ],
                            'birthdate',
                            'city',
                            'email:email',
                            'phone',
                            [
                                'format' => 'raw',
                                'label' => 'Экстренный контакт',
                                'value' => function($model) {
                                    return $model->emergency_first_name . ' ' . $model->emergency_last_name . '<br>' .
                                    'Тел: ' . $model->emergency_phone . '<br>' .
                                    'Родство: ' . $model->emergency_relation;
                                }
                            ],
                            'team',
                            'shirt_size',
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>