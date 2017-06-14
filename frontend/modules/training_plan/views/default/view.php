<?php
use yii\helpers\Html;
use training_plan\models\TrainingPlan;
?>
<div class="container">
    <h1 class="m-y-3"><?= $model->label ?></h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-block">
                    <div class="pull-left">
                        <?= Html::tag('h6', $model->sport->label, ['class' => 'sport-caption ' . $model->sportClass]);?>
                    </div>
                    <div class="clearfix"></div>
                    <?= Html::tag('div', Html::tag('i', $model->promo), ['class' => 'card-text PTSerif lead']);?>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <p class="m-b-0">
                                <?php
                                for ($i = 0; $i < 5; $i++) {
                                    if ($i < $model->level) {
                                        echo '<i class="fa fa-circle" aria-hidden="true"></i> ';
                                    }else {
                                        echo '<i class="fa fa-circle text-muted" aria-hidden="true"></i> ';
                                    }

                                }
                                ?>
                            </p>
                            <p class="small m-b-0">Уровень</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <p class="m-b-0">
                                <strong><?= $model->count;?></strong>
                            </p>
                            <p class="small m-b-0">Тренировки</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <p class="m-b-0">
                                <strong><?= $model->amount;?></strong>
                            </p>
                            <p class="small m-b-0">Недельный объём</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <p class="m-b-0">
                                <strong><?= $model->progress;?></strong>
                            </p>
                            <p class="small m-b-0">Объёмы</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <p class="m-b-0">
                                <strong><?= TrainingPlan::getFormatArray()[$model->format];?></strong>
                            </p>
                            <p class="small m-b-0">Формат плана</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <p class="m-b-0">
                                <strong><?= $model->author_name;?></strong>
                            </p>
                            <p class="small m-b-0">Автор</p>
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
                        <?php
                        if ($model->price) {
                            echo Html::a('Купить за ' . $model->price .' ₽', $model->author_site, ['class' => 'btn btn-danger btn-sm', 'target' => '_blank']);
                        }
                        ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card card-block">
                <?= $model->content;?>
            </div>
            <?php
            if (count($additionalModels)) {
                echo Html::tag('div', 'Ещё планы по триатлону',['class' => 'm-y-3']);
                echo Html::beginTag('div', ['class' => 'row']);
                foreach ($additionalModels as $model) {
                    echo $this->render('card', [
                        'model' => $model,
                        'cardClass' => 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6',
                    ]);
                }
                echo Html::endTag('div');
            }
            ?>
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
    </div>
</div>