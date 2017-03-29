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
        <?php if (Yii::$app->user->can('user')):?>
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
        <?php endif;?>
        <?php if (Yii::$app->user->can('post')):?>
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
        <?php endif;?>
        <?php if (Yii::$app->user->can('race')):?>
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
        <?php endif;?>
        <?php if (Yii::$app->user->can('product')):?>
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
        <?php endif;?>
    </div>
    <?php if (Yii::$app->user->can('user')):?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Зарегистрировавшиеся пользователи по дням</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="chart">
                            <canvas id="userChart" data-days='<?= $days;?>' data-users='<?= $users;?>' style="height: 180px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
</section>