<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model configuration\models\Configuration */

$this->title = 'Редактирование конфигурации: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Конфигурации', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="configuration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
