<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<div class="row form-group">
    <?php
    if (count($attrs)) {
        foreach ($attrs as $attr) {
            echo Html::beginTag('div', ['class' => 'col-xs-3']);
            echo Html::label($attr->label);
            echo Html::checkboxList('Attr[' . $attr->id . ']', $checkedAttr, ArrayHelper::map($attr->productAttrValues, 'id', 'label'), ['class' => 'checkbox-list']);
            echo Html::endTag('div');
        }
    }else {
        echo Html::beginTag('div', ['class' => 'col-xs-12']);
        echo 'В данной категории отсутствуют атрибуты';
        echo Html::endTag('div');
    }

    ?>
</div>
