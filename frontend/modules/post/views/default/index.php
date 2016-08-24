<?php
use \yii\helpers\Html;

/**
 * @var $featured \post\models\Post
 * @var $posts []
 */
?>
<div class="container">

    <?= \frontend\widgets\news\News::widget(['header' => 'Cамое новое']); ?>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="ad-sidebar text-xs-center">
                <img src="https://s-media-cache-ak0.pinimg.com/736x/2d/82/a6/2d82a6a6be76603d79a263f05ee96ac8.jpg">
            </div>
        </div>
        <?php if ($featured) { ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="card">
                    <?php if ($featured->image_id) { ?>
                        <?= Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($featured->image_id), ['class' => 'img-fluid card-img-top']); ?>
                    <?php } ?>
                    <div class="card-block">
                        <h6 class="magazine-caption report"><?= $featured->getType(); ?></h6>
                        <h4 class="card-title">
                            <?= Html::a($featured->label, ['/magazine/'. $featured->url], ['class' => 'underline-black']);?>
                        </h4>
                        <p><?= $featured->promo; ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="row m-t-1">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <?= \frontend\widgets\mostPopularPost\MostPopularPost::widget(); ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <?= \frontend\widgets\mostPopularPosts\MostPopularPosts::widget(); ?>
        </div>
    </div>
    <div class="row m-t-2">
        <ul class="flex-container">
            <?php /** @var $post \post\models\Post */?>
            <?php foreach ($posts as $post) { ?>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <li class="flex-item">
                        <div class="card">
                            <img src="https://process.filestackapi.com/AMUpLpMHnQfWBIrqRcYd3z/resize=width:800,height:450,fit:crop/http://www.trirussia.ru/magazine/img/paul_van_bike.jpg" class="img-fluid" class="card-img-top">
                            <div class="card-block">
                                <h6 class="magazine-caption news"><?= $post->getType(); ?></h6>
                                <h4 class="card-title"><a href="#" class="underline-black"><?= $post->label; ?></a></h4>
                                <p><?= $post->promo; ?></p>
                            </div>
                        </div>
                    </li>
                </div>
            <?php } ?>
        </ul>
    </div>
    <div class="race-block-container">
         <?= \frontend\widgets\mostPopularRaces\MostPopularRaces::widget(); ?>
    </div>
</div>