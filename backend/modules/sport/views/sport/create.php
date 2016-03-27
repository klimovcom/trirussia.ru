<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model sport\models\Sport */

$this->title = 'Создание вида спорта';
$this->params['breadcrumbs'][] = ['label' => 'Виды спорта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sport-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
