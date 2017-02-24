<?php
use yii\helpers\Html;
use metalguardian\fileProcessor\helpers\FPM;
use yii\helpers\ArrayHelper;
$formName = 'product_attr';
if ($type == 'normal') {
    $productBlockId = 'card';
    $itemCssClass = 'col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4';
}else {
    $productBlockId = 'list';
    $formId = 'product_view_large_';
    $itemCssClass = 'col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6';
}

echo Html::beginTag('div', ['class' => 'row', 'id' => $productBlockId]);
foreach ($products as $product) {
    echo Html::beginTag('div', ['class' => $itemCssClass]);
    echo Html::beginTag('div', ['class' => 'card card-block']);
    echo Html::tag('div', Html::a(Html::img(FPM::originalSrc($product->productImages[0]->image_id), ['class' => 'img-fluid']), ['view', 'url' => $product->url], ['class' => 'no-underline']), ['class' => 'js-tilt']);
    echo Html::tag('h5', Html::a($product->label, ['view', 'url' => $product->url], ['class' => 'no-underline']), ['class' => 'shop-title']);

    if ($type == 'normal') {
        echo Html::a('Купить за ' . $product->price . ' ₽', 'javascript:;', ['class' => 'btn btn-primary-outline btn-block btn-shop-add-cart', 'data-product-id' => $product->id]);
    }else {
        echo Html::tag('hr');
        echo Html::beginTag('form', ['class' => 'form-inline', 'id' => $formId . $product->id]);

        if (is_array(ArrayHelper::getValue($attrValuesArray, $product->id))) {
            $attrValues = ArrayHelper::index(ArrayHelper::getValue($attrValuesArray, $product->id), null, 'attr_id');
        }else {
            $attrValues = [];
        }

        if (count($attrValues)) {
            echo Html::beginTag('div', ['class' => 'pull-left hidden-md-down']);
            foreach ($attrValues as $attr_id => $values) {
                echo Html::beginTag('div', ['class' => 'form-group']);
                echo Html::dropDownList($formName . '[' . $attr_id .']', '', ArrayHelper::map($values, 'value.id', 'value.label'), ['class' => 'c-select']);
                echo Html::endTag('div');
            }
            echo Html::endTag('div');
        }

        echo Html::tag('div', Html::a('Купить за ' . $product->price . ' ₽', 'javascript:;', ['class' => 'btn btn-primary-outline btn-shop-add-cart', 'data-product-id' => $product->id, 'data-attr-block-id' => $formId . $product->id]), ['class' => 'pull-right']);
        echo Html::tag('div', '', ['class' => 'clearfix']);
        echo Html::endTag('form');
    }

    echo Html::endTag('div');
    echo Html::endTag('div');
}
echo Html::endTag('div');