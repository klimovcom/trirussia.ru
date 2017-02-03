<?php
use yii\helpers\Html;
?>
<div class="container">
    <h1 class="m-t-3 m-b-3">Специальные условия, скидки и промокоды только для пользователей TriRussia.ru</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="row">
                <ul class="flex-container">
                    <?php foreach ($models as $promocode):?>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <li class="flex-item">
                                <div class="card card-block">
                                    <h4 class="card-title">
                                        <?= Html::a($promocode->label, $promocode->url, ['class' => 'underline-black']);?>
                                    </h4>
                                    <div class="card-text m-b-1">
                                        <?= $promocode->promo;?>
                                    </div>
                                    <hr>
                                    <h6 class="partner-shop-caption tri text-xs-center">Специальные условия</h6>
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-3 col-xl-3">
                                            <h1 class="discount"><?= $promocode->discount;?>%</h1>
                                        </div>
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-9 col-xl-9">
                                            <div class="small m-b-0">
                                                <?= $promocode->conditions;?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="promocode-item--promocode  m-t-1 text-xs-center">
                                        <button class="btn btn-secondary btn-block promocode-item--promocode--button">Получить промокод</button>
                                        <span class="hidden promocode-item--promocode--text"><strong><?= $promocode->promocode;?></strong></span>
                                    </div>
                                </div>
                            </li>
                        </div>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
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
    </div>
</div>