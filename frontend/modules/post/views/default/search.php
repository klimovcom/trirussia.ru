<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
/**
 * @var $posts \post\models\Post[]
 */
?>
<div class="container">
    <div class="news-block-container">
        <h4 class="PTSerif"><i>Записи с тегом "<?= $_GET['tag'];?>":</i></h4>
    </div>

    <div class="row m-t-2">
        <ul class="flex-container">
            <?php /** @var $post \post\models\Post */?>
            <?php foreach ($posts as $post) { ?>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <li class="flex-item">
                        <div class="card">
                            <?= Html::a(
                                Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($post->image_id), ['class' => 'img-fluid card-img-top']),
                                ['/magazine/'.$post->url, ]
                            );?>
                            <div class="card-block">
                                <h6 class="magazine-caption news"><?= $post->getType(); ?></h6>
                                <h4 class="card-title">
                                    <?= Html::a($post->label, ['/magazine/'.$post->url, ], ['class'=>'underline-black'])?>
                                </h4>
                                <p><?= $post->promo; ?></p>
                            </div>
                        </div>
                    </li>
                </div>
            <?php } ?>
        </ul>
    </div>

</div>

