<?php
use \yii\helpers\Html;

/**
 * @var $post \post\models\Post
 */
?>

<div class="card">
    <div class="card-block border-gold">
        <h4 class="PTSerif"><i>Самое популярное</i></h4>
    </div>
    <?php if ($post->image_id) { ?>
        <?= Html::a(
            Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($post->image_id), ['class' => 'img-fluid']),
            ['/magazine/'.$post->url, ]
        );?>
    <?php } ?>
    <div class="card-block">
        <h6 class="magazine-caption report"><?= $post->getType(); ?></h6>
        <h4 class="card-title">
	        <?= Html::a($post->label, ['/magazine/'.$post->url, ], ['class'=>'underline-black'])?>
        </h4>
        <p><?= $post->promo; ?></p>
    </div>
</div>