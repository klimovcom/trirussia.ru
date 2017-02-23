<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model user\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <div class="box-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'fb_id')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'sex')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'locale')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'age')->textInput(['maxlength' => true]) ?>

        <?php if ($model->photo_url):?>
            <div class="form-group">
                <label class="control-label">Фото</label>
                <?= Html::img($model->photo_url, ['class' => 'img-responsive form-control-with-margin']);?>
            </div>
        <?php endif;?>

        <?= $form->field($model, 'status')->textInput() ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

        <hr>

        <h3>Данные параметры используются для входа в админку</h3>

        <div class="row">
            <div class="col-xs-6">
                <?= $form->field($model, 'role')->listBox(
                    ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description'), [
                        'multiple' => false
                    ]
                );
                ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($model, 'password')->textInput();?>
            </div>
        </div>

    </div>
    <div class="box-footer">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= $model->isNewRecord ? '' : Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger pull-right',
                'data' => [
                    'confirm' => 'Вы действительно хотите удалить этот объект?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
