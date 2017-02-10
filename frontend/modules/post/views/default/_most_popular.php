<?php
use yii\helpers\Html;
?>

<div class="card">
    <div class="card-block border-gold">
        <h4 class="PTSerif"><i>Ещё интересно</i></h4>
        <hr>
        <div class="row">
            <ul class="flex-container">
                <?php foreach ($posts as $post):?>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <li class="flex-item">
                            <?= Html::a(
                                Html::tag('div', Html::img(false, ['class' => 'embed-responsive-item lazy most-wanted', 'alt' => $post->label, 'title' => $post->label, 'data-original' => \metalguardian\fileProcessor\helpers\FPM::originalSrc($post->image_id)]), ['class' => 'embed-responsive embed-responsive-16by9']),
                                ['/post/default/view', 'url' => $post->url]
                            );?>
                            <h5 class="m-t-1"><?= Html::a($post->label, ['/post/default/view', 'url' => $post->url], ['class' => 'no-underline']);?></h5>
                        </li>
                    </div>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>