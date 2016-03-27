<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model coach\models\Coach */

$this->title = 'Редактирование Тренера: ' . ' ' . $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Тренеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="coach-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
