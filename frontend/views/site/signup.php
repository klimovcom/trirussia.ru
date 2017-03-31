<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <h1 class="m-t-3 m-b-3">Регистрация</h1>
            <?php
            $form = ActiveForm::begin([
                'id' => 'login-form',
            ]);
            echo $form->field($model, 'email');
            echo $form->field($model, 'password');
            ?>
            <div class="form-group">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-secondary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>