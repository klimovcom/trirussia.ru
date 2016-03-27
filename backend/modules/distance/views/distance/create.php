<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model distance\models\Distance */

$this->title = 'Создание дистанции';
$this->params['breadcrumbs'][] = ['label' => 'Дистанции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
