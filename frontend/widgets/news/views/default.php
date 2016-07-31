<?php
/**
 * @var $news array
 * @var $new \post\models\Post
 * @var $this \yii\web\View
 */

use \yii\helpers\Html;

/** @var $firstNew \post\models\Post */
$firstNew = array_shift($news);
?>

<div class="news-block-container">
    <h4 class="PTSerif">
        <?php if ($this->context->header) { ?>
            <i><?= $this->context->header; ?></i>
        <?php } else { ?>
            <i>Новости из <?= Html::a('журнала TriRussia.ru	', ['/magazine/'], ['class'=>'underline'])?></i>
        <?php } ?>

    </h4>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <hr>
            <h6 class="magazine-caption news"><?= $firstNew->getType(); ?></h6>
            <h2>
                <?= Html::a($firstNew->label, ['/magazine/'.$firstNew->url, ], ['class'=>'no-underline'])?>
            </h2>
            <p><?= $firstNew->promo; ?></p>
            <span class="text-muted small"><?= Yii::$app->formatter->asDate($firstNew->created, 'd MMMM yyyy') . ' г.'; ?></span>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="row">
                <ul class="flex-container">
                    <?php foreach ($news as $new){ ?>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <li class="flex-item">
                                <hr>
                                <h6 class="magazine-caption news"><?= $new->getType(); ?></h6>
                                <h5>
                                    <?= Html::a($new->label, ['/magazine/'.$new->url, ], ['class'=>'no-underline'])?>
                                </h5>
                                <span class="text-muted small">
                                    <?= Yii::$app->formatter->asDate($new->created, 'd MMMM yyyy') . ' г.'; ?>
                                </span>
                            </li>
                        </div>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
