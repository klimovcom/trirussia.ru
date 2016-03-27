<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model race\models\Race */

$this->title = 'Редактирование гонки: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Гонки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="race-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
