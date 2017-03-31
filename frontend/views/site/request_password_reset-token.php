<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Alert;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <h1 class="m-t-3 m-b-3">Сброс пароля</h1>
            <?= Yii::$app->session->getFlash('success') ? yii\bootstrap\Alert::widget([
                'options' => [
                    'class' => 'alert-info',
                ],
                'body' => Yii::$app->session->getFlash('success'),
            ]) : '';?>
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'email')->label('Введите почту'); ?>

            <div class="form-group">
                <?= Html::submitButton('Восстановить пароль', ['class' => 'btn btn-secondary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>