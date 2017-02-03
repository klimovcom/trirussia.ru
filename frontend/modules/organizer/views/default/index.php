<?php
use yii\helpers\Html;
?>

<div class="container">
    <h1 class="m-t-3 m-b-3">Организаторы соревнований по триатлону, бегу, плаванию и велоспорту</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card-columns">
                <?php
                foreach ($organizers as $org) {
                    echo Html::beginTag('div', ['class' => 'card card-block']);
                    echo Html::tag('h4',
                        Html::a($org->label, ['/site/search-races', 'organizer' => $org->label], ['class' => 'underline']),
                        ['class' => 'card-title']);
                    echo Html::tag('div', $org->promo, ['class' => 'm-b-1']);
                    Yii::info($org->image_id);
                    echo Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($org->image_id), ['class' => 'card-organizer-logo']);
                    echo Html::endTag('div');
                }
                ?>
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