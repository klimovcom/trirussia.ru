<?php

/**
 * @var $this yii\web\View
 * @var integer $userCount
 * @var integer $postCount
 * @var integer $raceCount
 * @var integer $productCount
 */

$this->title = 'Triatrussia admin panel';
?>

<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $userCount; ?></h3>
                    <p>Пользователей</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to('/user/user/index'); ?>" class="small-box-footer">
                    Редактировать <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3><?= $postCount; ?></h3>
                    <p>Статей</p>
                </div>
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to('/post/post/create'); ?>" class="small-box-footer">
                    Добавить статью <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= $raceCount; ?></h3>
                    <p>Соревнований</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to('/race/race/create'); ?>" class="small-box-footer">
                    Добавить соревнование <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?= $productCount; ?></h3>
                    <p>Товаров</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="<?= \yii\helpers\Url::to('/product/product/create'); ?>" class="small-box-footer">
                    Добавить товар <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>