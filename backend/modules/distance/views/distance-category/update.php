<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model distance\models\DistanceCategory */

$this->title = 'Редактирование категории дистанций: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Категории дистанций', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="distance-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
