<?php
use yii\helpers\Html;
?>
<div class="form-group row">
    <label class="col-sm-4 form-control-label">Дистанция</label>
    <div class="col-sm-8">
        <?= Html::activeCheckboxList($model, 'distancesArray', $distancesArray, [
            'item'=>function ($index, $label, $name, $checked, $value){
                return Html::beginTag('div', ['class' => 'checkbox']) .
                Html::beginTag('label') .
                Html::checkbox($name, $checked, [
                    'value' => $value,
                ]) .
                ' ' . $label .
                Html::endTag('label') .
                Html::endTag('div');
            },
        ]);?>
    </div>
</div>

<?php
foreach ($categoriesArray as $category) {
    echo Html::activeHiddenInput($model, 'categoriesArray[]', [
        'value' => $category,
    ]);
}
?>