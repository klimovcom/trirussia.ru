<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 5/19/16
 * Time: 7:06 PM
 * @var $race \race\models\Race
 */
use \willGo\models\WillGo;
$this->registerCssFile('https://fonts.googleapis.com/css?family=Roboto:300,400,500');
$this->registerJsFile("https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places");
if (Yii::$app->user->isGuest) {
    $ratingInputClass = 'rating-input';
}else {
    $ratingInputClass = 'rating-input rating-input-active';
}
?>

<div class="container">
    <h1 class="m-t-3"><?= $race->label ?></h1>
    <h4 class="m-b-3"><?= $race->getPlaceTimePromo(); ?></h4>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">

            <div class="alert alert-info">
                Это соревнование завершено.
            </div>

            <div class="card card-block">
                <h4>Поставьте оценку и <a href="#comment" class="underline">оставьте комментарий</a></h4>
                <p>Если вы были участником этого соревнования, помогите организаторам сделать его лучше &mdash; поставьте оценку. Ваш голос очень поможет.</p>
                <h4>
                    <div class="<?= $ratingInputClass;?>" data-rate="<?= round($race->rating);?>" data-race="<?= $race->id;?>">
                        <input type="hidden" name="" value="<?= round($race->rating);?>" class="rating-input--value">
                        <div class="rating-input--part rating-input--filled">
                            <i class="fa fa-star gold rating-input--star" aria-hidden="true"></i>
                            <i class="fa fa-star gold rating-input--star" aria-hidden="true"></i>
                            <i class="fa fa-star gold rating-input--star" aria-hidden="true"></i>
                            <i class="fa fa-star gold rating-input--star" aria-hidden="true"></i>
                            <i class="fa fa-star gold rating-input--star" aria-hidden="true"></i>
                        </div>
                        <div class="rating-input--part rating-input--not-filled">
                            <i class="fa fa-star-o gold rating-input--star" aria-hidden="true"></i>
                            <i class="fa fa-star-o gold rating-input--star" aria-hidden="true"></i>
                            <i class="fa fa-star-o gold rating-input--star" aria-hidden="true"></i>
                            <i class="fa fa-star-o gold rating-input--star" aria-hidden="true"></i>
                            <i class="fa fa-star-o gold rating-input--star" aria-hidden="true"></i>
                        </div>
                        <span class="rating-input--text"><?= number_format(round($race->rating, 2), 2, '.', '');?></span>
                    </div>

                </h4>
            </div>

            <div class="card">
                <?php if ($race->main_image_id) { ?>
                    <?= \yii\helpers\Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($race->main_image_id), [
                        'class' => 'card-img-top img-fluid',
                        'alt' => $race->label,
                    ]); ?>
                <?php } ?>
                <div class="card-block border-run">
                    <div class="pull-left">
                        <h6 class="sport-caption run"><?= $race->sport->label; ?></h6>
                    </div>
                    <div class="clearfix"></div>
                    <p class="card-text PTSerif lead"><i><?= $race->promo; ?></i></p>
                    <hr>
                    <div class="row">
                        <?php if (!empty($race->place))  { ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <p class="m-b-0"><strong><?= $race->place; ?></strong></p>
                                <p class="small m-b-0">Место</p>
                            </div>
                        <?php } ?>
                        <?php if (!empty($race->start_date))  { ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                                <p class="m-b-0"><strong><?= $race->getDateRepresentation(); ?></strong></p>
                                <p class="small m-b-0">Дата</p>
                            </div>
                        <?php } ?>
                        <?php if ($distances = $race->getDistancesRepresentation()) { ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <p class="m-b-0"><strong><?= $distances; ?></strong></p>
                                <p class="small m-b-0">Дистанция</p>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
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
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card m-t-1">
                <div id="comment" class="card-block">
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
        </div>
    </div>
</div>