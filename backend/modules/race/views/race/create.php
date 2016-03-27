<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model race\models\Race */

$this->title = 'Создание гонки';
$this->params['breadcrumbs'][] = ['label' => 'Гонки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
