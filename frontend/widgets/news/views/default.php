<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 7/11/16
 * Time: 1:13 AM
 * @var $news array
 * @var $new \post\models\Post
 */
/** @var $firstNew \post\models\Post */
$firstNew = array_shift($news);
?>

<div class="news-block-container">
    <h4 class="PTSerif"><i>Новости из <a href="#" class="underline">журнала TriRussia.ru	</a></i></h4>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <hr>
            <h6 class="magazine-caption news">Новости</h6>
            <h2><a href="#" class="no-underline"><?= $firstNew->label; ?></a></h2>
            <span class="text-muted small">><?= Yii::$app->formatter->asDate($firstNew->created, 'd MMMM yyyy') . ' г.';; ?></span>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="row">
                <ul class="flex-container">
                    <?php foreach ($news as $new){ ?>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <li class="flex-item">
                                <hr>
                                <h6 class="magazine-caption news">Новости</h6>
                                <h5><a href="#" class="no-underline"><?= $new->label; ?></a></h5>
                                <span class="text-muted small"><?= Yii::$app->formatter->asDate($new->created, 'd MMMM yyyy') . ' г.'; ?></span>
                            </li>
                        </div>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
