<?php
use yii\helpers\Html;
use metalguardian\fileProcessor\helpers\FPM;

$imageArray = $model->productImages;
$mainImage = array_shift($imageArray);

?>
<?= $this->render('_cart');?>
<div class="container">
    <div class="row m-t-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="card card-block">
                <?= Html::img(FPM::originalSrc($mainImage->image_id), ['class' => 'img-fluid']);?>
                <?php if(count($imageArray)):?>
                    <div class="row m-t-1">
                        <?php foreach($imageArray as $img):?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <?= Html::img(FPM::originalSrc($img->image_id), ['class' => 'img-fluid']);?>
                        </div>
                        <?php endforeach;?>
                    </div>
                <?php endif;?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="card card-block">
                <h4><?= $model->label;?></h4>
                <div>
                    <?= $model->promo;?>
                </div>
                <hr>
                <?= $this->render('_attrs', [
                    'model' => $model,
                    'attrArray' => $attrArray,
                    'attrValuesArray' => $attrValuesArray,
                ]);?>
                <?php if($model->content):?>
                    <div>
                        <?= $model->content;?>
                    </div>
                    <hr>
                <?php endif;?>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
						<img src="../img/delivery.png" style="height: 50px;">
						<p class="small m-b-0">Бесплатная доставка от 3000 ₽</p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
						<img src="../img/card.png" style="height: 50px;">
						<p class="small m-b-0">Оплата картой на сайте</p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
						<img src="../img/return.png" style="height: 50px;">
						<p class="small m-b-0">Бесплатные возврат или замена</p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
						<img src="../img/quality.png" style="height: 50px;">
						<p class="small m-b-0">96% клиентов счастливы и довольны</p>
					</div>
				</div>
				<hr>
                <button class="btn btn-danger btn-lg m-t-1 m-b-1  btn-shop-add-cart" data-product-id="<?= $model->id;?>", data-attr-block-id="<?= 'product_attr_block-' . $model->id;?>">Купить за <?= $model->price;?> ₽</button>                
            </div>
        </div>
    </div>
</div>