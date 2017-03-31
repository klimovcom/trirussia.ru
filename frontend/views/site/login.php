<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <h1 class="m-t-3 m-b-3">Войдите на сайт</h1>
            <?php
            $form = ActiveForm::begin([
                'id' => 'login-form',
            ]);
            echo $form->field($model, 'username');
            echo $form->field($model, 'password')->passwordInput();
            ?>
            <p>
                <?= Html::a('Забыли пароль?', ['/site/request-password-reset'], ['class' => 'underline']) ?>
            </p>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <div class="form-group">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-secondary']) ?>
                <?= Html::a('Регистрация', ['/site/signup'], ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>