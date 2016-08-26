<?php
use yii\helpers\Url;

/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 5/30/16
 * Time: 9:03 PM
 * @var array $races
 * @var array $notJoinedRaces
 */

?>
<div class="container">
    <h1 class="m-t-3 m-b-3">Мои соревнования</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card card-block">
                <p>Мы собрали все ваши соревнования и составили календарь. Вы всегда можете добавить соревнование, и оно
                    отобразится здесь. Таким простым и наглядным образом вы увидите «пустые» места в своём календаре и
                    сможете скорректировать план на сезон.</p>
                <hr>
                <ul class="list-unstyled">
                    <?php for (
                        $i = time();
                        $i <= strtotime(date("Y-m-t", time())) + (60*60*24-1) + strtotime('+2month')-strtotime('now');
                        $i+=60*60*24
                    ) { ?>
                        <?php if (isset($races[strtotime(date('Y-m-d', $i))])) { ?>
                            <?php /** @var \race\models\Race $race */?>
                            <?php foreach ($races[strtotime(date('Y-m-d', $i))] as $race) { ?>
                                <li class="border-r-<?= $race->getSportClass();?>">
                                    <h4 class="m-l-1"><span class="small"><?= $race->getDateRepresentation()?>, Вс&nbsp;&nbsp;</span>
                                        <a href="<?= $race->getViewUrl(); ?>" class="underline-black"><?= $race->label; ?></a>
                                    </h4>
                                    <p class="m-l-1 small"><?= $race->getDistancesRepresentation()?></p>
                                </li>
                            <?php }  ?>
                        <?php } else { ?>
                            <li class="border small text-muted">
                            <span class="m-l-1">
                                <?= Yii::$app->formatter->asDate(date('Y-m-d', $i), 'd MMMM yyyy') . ' г.'; ?>
                            </span>
                            <?php if (isset($notJoinedRaces[strtotime(date('Y-m-d', $i))])) { ?>
                                <?php $count = count($notJoinedRaces[strtotime(date('Y-m-d', $i))]); ?>
                                <?php /** @var \race\models\Race $race */?>
                                <?php foreach ($notJoinedRaces[strtotime(date('Y-m-d', $i))] as $race) { ?>
                                    <a href="<?= $race->getViewUrl(); ?>" class="underline">
                                        <?php if (--$count > 0) $label = $race->label . ','; else $label =  $race->label; ?>
                                        <?= $label; ?>
                                    </a>
                                <?php }  ?>
                            <?php } ?>
                            </li>
                        <?php }  ?>
                    <?php } ?>


                </ul>
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
</div>
