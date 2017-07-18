<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model user\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header user-view">
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
<section class="content user-view">
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот объект?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Сгенерировать новый ключ', ['generate-api-key', 'id' => $model->id], ['class' => 'btn btn-danger']);?>
    </p>
    <div class="row">
        <div class="col-xs-9">
            <div class="box box-primary">
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'created_at' => [
                                'attribute' => 'created_at',
                                'value' => date('d.m.Y', $model->created_at),
                            ],
                            'fb_id',
                            'email',
                            'username',
                            'first_name',
                            'last_name',
                            'sex',
                            'locale',
                            'timezone',
                            'age',
                            'birthday',
                            'place',
                            /*'auth_key',
                            'password_hash',
                            'password_reset_token',*/
                            /*'status',*/
                            'api_key',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>
