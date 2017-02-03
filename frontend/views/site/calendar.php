<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 5/30/16
 * Time: 9:03 PM
 * @var array $joinedRacesArray
 * @var array $notJoinedRacesArray
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
                    <?php
                    for($i = time(); $i < strtotime('+1 year 1 day'); $i+= 60*60*24){

                        $isJoinedToday = false;
                        if ($joinedRacesToday = ArrayHelper::getValue($joinedRacesArray, date('Y-m-d', $i))) {
                            $isJoinedToday = true;
                            foreach ($joinedRacesToday as $race) {
                                echo Html::beginTag('li', ['class' => 'border-r-' . $race->getSportClass()]);
                                echo Html::beginTag('h4', ['class' => 'm-l-1']);
                                echo Html::tag('span', Yii::$app->formatter->asDate($i, 'd MMMM yyyy') . ' г., ' . Yii::$app->formatter->asDate($i, 'EEE') . '&nbsp;&nbsp;', ['class' => 'small']);
                                echo Html::a($race->label, $race->getViewUrl(), ['class' => 'underline-black']);
                                echo Html::endTag('h4');
                                echo Html::tag('p', $race->getDistancesRepresentation(), ['class' => 'm-l-1 small']);
                                echo Html::endTag('li');
                            }
                        }


                        $notJoinedToday = '';
                        if ($notJoinedRacesToday = ArrayHelper::getValue($notJoinedRacesArray, date('Y-m-d', $i))) {
                            $notJoinedToday = implode(', ', ArrayHelper::getColumn($notJoinedRacesToday, function($el) {
                                return Html::a($el->label, $el->getViewUrl(), ['class' => 'underline']);
                            }));
                        }

                        echo Html::beginTag('li', ['class' => 'border small text-muted']);
                        if ($isJoinedToday) {
                            echo $notJoinedToday ? Html::tag('p', 'Еще в этот день: ' . $notJoinedToday, ['class' => 'm-l-1 m-t-0']) : '';
                        }else {
                            echo Html::tag('span', Yii::$app->formatter->asDate($i, 'd MMMM yyyy') . ' г. ', ['class' => 'm-l-1 m-r-1']);
                            echo $notJoinedToday;
                        }
                        echo Html::endTag('li');


                    }
                    ?>
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