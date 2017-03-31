<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <h1 class="m-t-3 m-b-3">Регистрация</h1>
            <?= Yii::$app->session->getFlash('success') ? yii\bootstrap\Alert::widget([
                'options' => [
                    'class' => 'alert-info',
                ],
                'body' => Yii::$app->session->getFlash('success'),
            ]) : '';?>
            <?php
            $form = ActiveForm::begin([
                'id' => 'login-form',
            ]);
            echo $form->field($model, 'password')->passwordInput()->label('Новый пароль');
            ?>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-secondary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>