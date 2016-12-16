<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use metalguardian\fileProcessor\helpers\FPM;
use yii\helpers\Url;
?>
<?= $this->render('_cart');?>
<div class="container">
    <div class="card card-block">
        <div class="pull-left">
            <div class="form-group m-b-0">
                <?= Html::dropDownList('', $sort, [
                    'popularity' => 'По популярности',
                    'price_asc' => 'От дешевых к дорогим',
                    'price_desc' => 'От дорогих к дешевым',
                ], [
                    'class' => 'c-select small sort-select',
                    'data-popularity' => Url::current(['sort' => 'popularity']),
                    'data-price_asc' => Url::current(['sort' => 'price_asc']),
                    'data-price_desc' => Url::current(['sort' => 'price_desc']),
                ])?>
            </div>
        </div>
        <div class="pull-right">
            <button class="btn btn-sm btn-secondary" id="option1"><i class="fa fa-th" aria-hidden="true"></i></button>
            <button class="btn btn-sm btn-secondary" id="option2"><i class="fa fa-th-large" aria-hidden="true"></i></button>
        </div>
        <div class="clearfix"></div>
    </div>

    <?php
    foreach ($categories as $category) {

        //блок категории
        echo Html::beginTag('div', ['class' => 'card m-t-3 shop-hero', 'style' => 'background-image: url("' . FPM::originalSrc($category->image_id) .'")']);
        echo Html::tag('h2', $category->label, ['class' => 'm-t-3']);
        echo Html::tag('div', $category->content);
        echo Html::endTag('div');
        //блок входящих в категорию продуктов
        if (is_array(ArrayHelper::getValue($productsArray, $category->id))) {
            echo $this->render('_product_index_card', [
                'products' => ArrayHelper::getValue($productsArray, $category->id),
                'attrValuesArray' => $attrValuesArray,
                'type' => 'normal'
            ]);
            echo $this->render('_product_index_card', [
                'products' => ArrayHelper::getValue($productsArray, $category->id),
                'attrValuesArray' => $attrValuesArray,
                'type' => 'large'
            ]);
        }
    }
    ?>

</div>