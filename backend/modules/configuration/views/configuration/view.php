<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model configuration\models\Configuration */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Конфигурации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuration-view">

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
            'label',
            'description:ntext',
            'key',
            'value',
        ],
    ]) ?>

</div>
