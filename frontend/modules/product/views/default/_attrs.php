<?php
use yii\helpers\Html;
use product\models\ProductAttr;
use yii\helpers\ArrayHelper;

$formName = 'product_attr';

if (count($attrValuesArray)) {
    echo Html::beginTag('form', ['id' => 'product_attr_block-' . $model->id]);
    foreach ($attrValuesArray as $attr_id => $values) {
        echo Html::tag('p', $attrArray[$attr_id]->label, ['class' => 'small shop-item-desc-label m-t-1']);

        switch ($attrArray[$attr_id]->type) {
            case ProductAttr::TYPE_DROPDOWN :
                echo Html::beginTag('div', ['class' => 'row']);
                echo Html::beginTag('div', ['class' => 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6']);
                echo Html::dropDownList($formName . '[' . $attr_id .']', null, ArrayHelper::map($values, 'value.id', 'value.label'), ['class' => 'c-select']);
                echo Html::endTag('div');
                echo Html::endTag('div');
                break;
            case ProductAttr::TYPE_LIST :
                echo Html::radioList($formName . '[' . $attr_id .']', null, ArrayHelper::map($values, 'value.id', 'value.label'), [
                    'class' => 'btn-group',
                    'data-toggle' => 'buttons',
                    'itemOptions' => [
                        'labelOptions' => [
                            'class' => 'btn btn-secondary',
                        ]
                    ],
                ]);
                break;
        }
    }
    echo Html::endTag('form');
    echo Html::tag('hr');
}
