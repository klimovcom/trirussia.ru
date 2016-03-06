<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model coach\models\Coach */

$this->title = 'Create Coach';
$this->params['breadcrumbs'][] = ['label' => 'Coaches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coach-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
