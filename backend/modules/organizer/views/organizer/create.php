<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model organizer\models\Organizer */

$this->title = 'Создание организатора';
$this->params['breadcrumbs'][] = ['label' => 'Организаторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
