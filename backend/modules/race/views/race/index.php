<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel race\models\RaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Гонки';
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
    <p><a href="<?= \yii\helpers\Url::to('/race/race/create'); ?>" class="btn btn-primary">Добавить соревнование</a></p>
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
                           'start_date',
                            [
                                'attribute' => 'label',
                                'format' => 'raw',
                                'value' => function($model){
                                    $label = !empty($model->label) ? $model->label : '(не задано)';
                                    return Html::a($label, \yii\helpers\Url::to('/race/race/view/' . $model->id));
                                }
                            ],
                            'sport_id' => [
                                'attribute' => 'sport_id',
                                'value' => function ($model) {
                                    $sport = \sport\models\Sport::findOne($model->sport_id);
                                    if ($sport)
                                        return $sport->label;
                                    return null;
                                },
                                'filter' => \yii\helpers\ArrayHelper::map(\sport\models\Sport::find()->all(), 'id', 'label'),
                            ],
                            'organizer_id' => [
                                'attribute' => 'organizer_id',
                                'value' => function ($model) {
                                    $organizer = \organizer\models\Organizer::findOne($model->organizer_id);
                                    if ($organizer)
                                        return $organizer->label;
                                    return null;
                                },
                                'filter' => \yii\helpers\ArrayHelper::map(\organizer\models\Organizer::find()->all(), 'id', 'label'),
                            ],
                            [
                                'attribute' => 'facebook_event_id',
                                'format' => 'raw',
                                'value' => function($model){
                                    $fbId = !empty($model->facebook_event_id) ? $model->facebook_event_id : '(не задано)';
                                    return Html::a($fbId, \yii\helpers\Url::to('http://www.facebook.com'));
                                }
                            ],
                            'popularity',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>