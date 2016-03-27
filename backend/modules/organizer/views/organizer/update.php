<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model organizer\models\Organizer */

$this->title = 'Редактирование организатора: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Организаторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="organizer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
