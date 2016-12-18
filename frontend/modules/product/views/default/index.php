<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use metalguardian\fileProcessor\helpers\FPM;
use yii\helpers\Url;
?>
<?= $this->render('_cart');?>
<div class="container">

    <?php
    if (is_array(ArrayHelper::getValue($banners, \product\models\ProductBanner::TYPE_BEFORE))) {
        foreach (ArrayHelper::getValue($banners, \product\models\ProductBanner::TYPE_BEFORE) as $banner) {
            echo $banner->content;
        }
    }
    ?>

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
    echo $this->render('_product_index_card', [
        'products' => $products,
        'attrValuesArray' => $attrValuesArray,
        'type' => 'normal'
    ]);
    echo $this->render('_product_index_card', [
        'products' => $products,
        'attrValuesArray' => $attrValuesArray,
        'type' => 'large'
    ]);
    ?>

    <?php
    if (is_array(ArrayHelper::getValue($banners, \product\models\ProductBanner::TYPE_AFTER))) {
        foreach (ArrayHelper::getValue($banners, \product\models\ProductBanner::TYPE_AFTER) as $banner) {
            echo $banner->content;
        }
    }
    ?>

</div>