<?php
use \yii\helpers\Html;

/**
 * @var $posts \post\models\Post
 */
?>
<div class="card">
    <div class="card-block border-gold">
        <h4 class="PTSerif"><i>Почитайте ещё</i></h4>
        <div class="row">
            <ul class="flex-container">
                <?php /** @var $post \post\models\Post */ ?>
                <?php foreach ($posts as $post){?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <li class="flex-item">
                            <hr>
                            <h6 class="magazine-caption news">
                                <?= $post->getType(); ?>
                            </h6>
                            <h5>
                                <a href="#" class="no-underline"><?= $post->label; ?></a>
                            </h5>
                            <span class="text-muted small"><?= Yii::$app->formatter->asDate($post->created, 'd MMMM yyyy'); ?></span>
                        </li>
                    </div>
                <?php }?>
            </ul>
        </div>
    </div>
</div>