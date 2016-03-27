<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model distance\models\DistanceCategory */

$this->title = 'Создание категории дистанций';
$this->params['breadcrumbs'][] = ['label' => 'Категории дистанций', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distance-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
