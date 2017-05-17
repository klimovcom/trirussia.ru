<?php
use \willGo\models\WillGo;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->registerCssFile('https://fonts.googleapis.com/css?family=Roboto:300,400,500');
$this->registerJsFile("https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places");

$price = $model->getPriceRepresentation() ? $model->getPriceRepresentation() : Html::tag('span', 'Нет цены', ['class' => 'text-muted']);
?>

<div class="container">
    <h1 class="m-t-3"><?= $model->label ?></h1>
    <h4 class="m-b-3">
        <?= Yii::$app->formatter->asDate(strtotime($model->date_start), 'd MMMM yyyy') . ' - ' . Yii::$app->formatter->asDate(strtotime($model->date_end), 'd MMMM yyyy') . '. ' . $model->country . ', ' . $model->region;?>
    </h4>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card">
                <?php if ($model->image_id) { ?>
                    <?= \yii\helpers\Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($model->image_id), [
                        'class' => 'card-img-top img-fluid',
                        'alt' => $model->label,
                    ]); ?>
                <?php } ?>
                <div class="card-block border-gray">
                    <div class="pull-left">
                        <h6 class="sport-caption gray">
                            <?php
                            echo implode(', ', ArrayHelper::getColumn($model->sports, 'label'));
                            ?>
                        </h6>
                    </div>
                    <div class="clearfix"></div>
                    <p class="card-text PTSerif lead"><i><?= $model->promo; ?></i></p>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <p class="m-b-0"><strong><?= Html::a($model->organizer->label, ['/camp/default/search', 'organizer' => $model->organizer->id], ['class' => 'underline']); ?></strong></p>
                            <p class="small m-b-0">Организатор</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <p class="m-b-0"><strong><?= $model->getDaysRepresentation(); ?></strong></p>
                            <p class="small m-b-0">Длительность</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <p class="m-b-0"><strong><?= $model->getPriceRepresentation(); ?></strong></p>
                            <p class="small m-b-0">Стоимость</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                            <p class="m-b-0"><strong><?= $model->is_accommodation ? 'Включено' : 'Не включено';?></strong></p>
                            <p class="small m-b-0">Проживание</p>
                        </div>
                    </div>
                    <hr>
                    <div class="pull-left hidden-sm-down">
                        <div class="likely">
                            <div class="facebook">Поделиться</div>
                            <div class="twitter">Твитнуть</div>
                            <div class="vkontakte">Поделиться</div>
                        </div>
                    </div>
                    <div class="pull-right hidden-sm-down i-will-go">
                        <a class="btn btn-danger btn-sm" href="<?= $model->organizer->site;?>">Купить за <?= $model->getPriceRepresentation(); ?></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-block">
                    <h2>Описание</h2>
                    <div class="fancybox_container">
                        <?= $model->description; ?>
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
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <?php if($model->coord_lat && $model->coord_lon) { ?>
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title m-b-0">Где проходят сборы</h4>
                    </div>
                    <div id="googleMap" data-lon="<?=$model->coord_lon;?>" data-lat="<?=$model->coord_lat;?>" style="height:455px;"></div>
                </div>
            <?php } ?>
            <div class="card m-t-1">
                <?= \frontend\widgets\moreRaces\MoreRaces::widget([])?>
            </div>
            <div class="card m-t-1">
                <div class="card-block">
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sidebar">
            <?= \frontend\widgets\allRaces\AllRaces::widget(['raceView' => true, ]); ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 hidden new-sidebar">
            <?= \frontend\widgets\allRaces\AllRaces::widget(['raceView' => true, ]); ?>
            <div class="ad-sidebar text-xs-center">
                <a href="https://www.asics.ru/running/products/gel-kayano-men/" target="_blank"><img src="http://files.www.fleetfeetraleigh.com/news/cq5dam.thumbnail.400.400-process-s400x333.png"></a>
            </div>
        </div>
    </div>
</div>
