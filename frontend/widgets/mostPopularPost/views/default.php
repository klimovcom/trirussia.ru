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
    <?= $post->image_id ? Html::a(
        Html::tag('div', Html::img(false, ['class' => 'embed-responsive-item lazy most-popular-post', 'data-original' => \metalguardian\fileProcessor\helpers\FPM::originalSrc($post->image_id)]), ['class' => 'embed-responsive embed-responsive-16by9']),
        ['/post/default/view', 'url' => $post->url]
    ) : '';?>

    <div class="card-block">
        <h6 class="magazine-caption report"><?= $post->getType(); ?></h6>
        <h4 class="card-title">
	        <?= Html::a($post->label, ['/post/default/view', 'url' => $post->url], ['class'=>'underline-black'])?>
        </h4>
        <p><?= $post->promo; ?></p>
    </div>
</div>