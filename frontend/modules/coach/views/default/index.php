<?php
use yii\helpers\Html;
use yii\helpers\Url;
use metalguardian\fileProcessor\helpers\FPM;
?>

<div class="container">
    <h1 class="m-t-3 m-b-3">Клубы и тренеры по триатлону, бегу, плаванию и велоспорту</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card card-block">
                <a href="http://sapik.team/?utm_source=trirussia&utm_medium=banner&utm_term=triathlon&utm_campaign=triathlon-sponsorship" class="no-underline" target="_blank">
                    <div class="sapik-wrapper">
                        <div class="sapik-container">
                            <h4 class="m-t-0 m-b-0">Тренеры из Sapik Team готовят любителей к триатлону и спонсируют эту рубрику</h4>
                        </div>
                    </div>
                </a>
                <h4 class="m-t-2">Профессиональное наблюдение — это важно</h4>
                <p>
                    Если вы хотите начать заниматься триатлоном, бегом, плаванием или велоспортом, то это стоит делать только под профессиональным руководством опытного тренера. К счастью, сейчас возможность заниматься есть практически у каждого вне зависимости от места жительства, т.к. тренер может наблюдать за результатами, строить план подготовки и давать рекомендации удалённо по почте, телефону или Скайпу.
                </p>
                <h4 class="m-t-1">Тренироваться с кем-то — это весело</h4>
                <p>
                    Участие в спортивном клубе или тренировки с тренером позволят разнообразить занятия. Это правда. Во-первых, будет не так скучно во время длительных тренировок, во-вторых, вместе интереснее участвовать в соревнованиях, в-третьих, это просто здорово: чувствовать сопричастность к большой триатлонной тусовке.
                </p>
                <h4 class="m-t-1">Выбирайте лучших</h4>
                <p>
                    Мы изучали и отбирали лучшие клубы и самых известных тренеров, для каждого из которых подготовили короткое описание, поэтому вам осталось сделать выбор. Кто-то дороже, кто-то дешевле. У кого-то за плечами Айронмены, Олимпиады и Чемпионаты мира, а у кого-то большой тренерский опыт. Но действительно оценить тренера могут только его ученики. Удачных тренировок!
                </p>
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
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card-columns">
                <?php foreach ($models as $trainer):?>
                    <div class="card">
                        <a href="<?= Url::to(['/coach/default/view', 'url' => $trainer->url]);?>" class="no-underline">
                            <div class="training-card">
                                <div class="card-img-top card--generated-bg coach-item--bg" data-label="<?= $trainer->label;?>"></div>
                            </div>
                            <?= Html::img(FPM::originalSrc($trainer->image_id), ['class' => 'avatar']);?>
                        </a>
                        <div class="card-block">
                            <h4 class="text-xs-center">
                                <?= Html::a($trainer->label, ['/coach/default/view', 'url' => $trainer->url], ['class' => 'underline']);?>
                            </h4>
                            <div class="text-xs-center m-b-1">
                                <?= $trainer->promo;?>
                            </div>
                            <hr>
                            <ul class="list-inline text-xs-center m-b-0">
                                <?php foreach ($trainer->sports as $sport) {
                                    echo Html::tag('li', Html::img(FPM::originalSrc($sport->icon_id)), ['class' => 'list-inline-item m-l-1 m-r-1']);
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach;?>
                <div class="card card-block">
                    <h4>Добавить в справочник</h4>
                    <p>Если по какой-то причине вас или вашей компании нет в справочнике, это можно легко исправить. Просто напишите о себе на электронную почту <a href="mailto:artem@klimov.com" class="underline">artem@klimov.com</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>