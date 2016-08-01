<?php
use \yii\helpers\Html;

/**
 * @var $post \post\models\Post
 */

?>

<div class="container">
    <h1 class="m-t-3 m-b-3"><?= $post->label; ?></h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card">

                <?php if ($post->image_id) { ?>
                    <?= Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($post->image_id), ['class' => 'card-img-top img-fluid'], ['alt' => $post->label]); ?>
                <?php } ?>

                <div class="card-block border-gold">
                    <div class="pull-left">
                        <h6 class="magazine-caption report"><?= $post->getType(); ?></h6>
                    </div>
                    <div class="clearfix"></div>
                    <p class="card-text PTSerif lead"><i><?= $post->promo; ?></i></p>
                    <hr>
                    <article>
                        <?= $post->content; ?>
                    </article>
                    <a href="#" class="btn btn-secondary btn-sm">триатлон</a>
                    <a href="#" class="btn btn-secondary btn-sm">гели</a>
                    <a href="#" class="btn btn-secondary btn-sm">спортивное питание</a>
                    <hr>
                    <div class="likely">
                        <div class="facebook">Поделиться</div>
                        <div class="twitter">Твитнуть</div>
                        <div class="vkontakte">Поделиться</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sidebar">
            <div class="theiaStickySidebar">
                <div class="ad-sidebar text-xs-center">
                    <img src="https://s-media-cache-ak0.pinimg.com/736x/2d/82/a6/2d82a6a6be76603d79a263f05ee96ac8.jpg">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 hidden new-sidebar">
            <div class="ad-sidebar text-xs-center">
                <img src="https://s-media-cache-ak0.pinimg.com/736x/2d/82/a6/2d82a6a6be76603d79a263f05ee96ac8.jpg">
            </div>
            <div class="ad-sidebar text-xs-center">
                <img src="http://lightnup.ph/wp-content/uploads/2015/02/2XU2-300x250.jpg">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card card-block">
                <div id="disqus_thread"></div>
                <script type="text/javascript">
                    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                    var disqus_shortname = 'trirussia'; // required: replace example with your forum shortname

                    /* * * DON'T EDIT BELOW THIS LINE * * */
                    (function() {
                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="fb-page" data-href="https://www.facebook.com/trirussia/" data-tabs="timeline, events, messages" data-width="380" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <div class="fb-xfbml-parse-ignore">
                    <blockquote cite="https://www.facebook.com/trirussia/">
                        <a href="https://www.facebook.com/trirussia/">TriRussia.ru</a>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
