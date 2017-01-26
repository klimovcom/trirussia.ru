<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
/**
 * @var $post \post\models\Post
 */
?>
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5&appId=597412183700544";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div class="container">
    <h1 class="m-t-3 m-b-3"><?= $post->label; ?></h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card">
                <?php if ($post->image_id) { ?>
                    <?= Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($post->image_id), ['class' => 'card-img-top img-fluid', 'alt' => $post->label]); ?>
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
                    <?php foreach (explode(',', $post->tags) as $tag) { ?>
                        <a href="<?= Url::to(['/magazine/search', 'tag' => $tag]);?>" class="btn btn-secondary btn-sm">
                            <?= $tag;?>
                        </a>
                    <?php } ?>
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
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 hidden new-sidebar">
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
            <div class="ad-sidebar text-xs-center">
                <img src="http://lightnup.ph/wp-content/uploads/2015/02/2XU2-300x250.jpg">
            </div>
        </div>
    </div>

    <?php if (count($simularPostsArray)):?>
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-block border-gold">
                        <h4 class="PTSerif">Вам также может понравиться</h4>
                        <div class="row">
                            <ul class="flex-container">
                                <?php for ($i=0; $i<3; $i++) {
                                    $post = \yii\helpers\ArrayHelper::getValue($simularPostsArray, $i.'.post');
                                    if ($post) {
                                        ?>
                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                            <li class="flex-item">
                                                <hr>
                                                <h6 class="magazine-caption news">
                                                    <?= $post->getType(); ?>
                                                </h6>
                                                <h5>
                                                    <?= Html::a($post->label, ['/magazine/'.$post->url, ], ['class'=>'no-underline'])?>
                                                </h5>
                                                <span class="text-muted small"><?= Yii::$app->formatter->asDate($post->created, 'd MMMM yyyy'); ?></span>
                                            </li>
                                        </div>
                                    <?php }?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>

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
