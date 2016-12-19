<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$fieldOptions = [
    'labelOptions' => [
        'class' => 'form-control-label',
    ],
    'errorOptions' => [
        'class' => 'form-control-feedback help-block'
    ],
]
?>
<div class="container">
    <div class="row m-t-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card card-block">
                <h1 class="text-xs-center m-t-2 m-b-3">Данные для доставки</h1>
                <hr>
                <?php $form = ActiveForm::begin([
                    'errorCssClass' => 'has-danger',
                    'successCssClass' => 'has-success',
                ]);?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-t-2 m-b-2">
                            <div class="payment-form">
                                <?= $form->field($model, 'name', $fieldOptions)->textInput();?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <?= $form->field($model, 'phone', $fieldOptions)->textInput();?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <?= $form->field($model, 'email', $fieldOptions)->textInput();?>
                                    </div>
                                </div>
                                <?= $form->field($model, 'address', $fieldOptions)->textInput();?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <?= $form->field($model, 'date', $fieldOptions)->textInput();?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                        <?= $form->field($model, 'time', $fieldOptions)->dropDownList($timeArray, ['class' => 'c-select']);?>
                                    </div>
                                </div>
                                <?= $form->field($model, 'comment', $fieldOptions)->textarea(['placeholder' => 'Не обязательно', 'rows' => 6]);?>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-t-2 m-b-2">
                            <h5>Сроки доставки</h5>
                            <p>
                                Большинство представленных на сайте футболок всегда есть на нашем складе, но некоторые делаются под заказ. Поэтому срок изготовления и доставки занимает в среднем около 2—3 дней. Если вам нужно много футболок или срочно, лучше напишите на <a href="mailto:artem@klimov.com" class="underline">artem@klimov.com</a>. Мы обязательно вам поможем.
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-xs-right">
                            <span class="m-r-2"><strong>Итого: <?= Yii::$app->cart->getCost();?> ₽</strong></span><?= Html::submitButton('Далее: выбрать способ оплаты', ['class' => 'btn btn-danger btn-lg']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>
