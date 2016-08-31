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
				<!--  AdRiver code START. Type:300x250 Site: trirussia PZ: 0 BN: 1 -->
				<script type="text/javascript">
				var RndNum4NoCash = Math.round(Math.random() * 1000000000);
				var ar_Tail='unknown'; if (document.referrer) ar_Tail = escape(document.referrer);
				document.write(
				'<iframe src="' + ('https:' == document.location.protocol ? 'https:' : 'http:') + '//ad.adriver.ru/cgi-bin/erle.cgi?'
				+ 'sid=201788&bn=1&target=blank&w=300&h=600&bt=40&pz=0&rnd=' + RndNum4NoCash + '&tail256=' + ar_Tail
				+ '" frameborder=0 vspace=0 hspace=0 width=300 height=600 marginwidth=0'
				+ ' marginheight=0 scrolling=no></iframe>');
				</script>
				<noscript>
				<a href="//ad.adriver.ru/cgi-bin/click.cgi?sid=201788&bn=1&bt=40&pz=0&rnd=335117872" target=_blank>
				<img src="//ad.adriver.ru/cgi-bin/rle.cgi?sid=201788&bn=1&bt=40&pz=0&rnd=335117872" alt="-AdRiver-" border=0 width=300 height=600></a>
				</noscript>
				<!--  AdRiver code END  -->
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
		                    <?php if ($featured->image_id) { ?>
		                        <?= Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($featured->image_id), ['class' => 'img-fluid card-img-top']); ?>
		                    <?php } ?>
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