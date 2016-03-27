<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model post\models\Post */

$this->title = 'Создание публикации';
$this->params['breadcrumbs'][] = ['label' => 'Публикации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
