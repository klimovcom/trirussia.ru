<?php
use willGo\models\WillGo;
$quest = Yii::$app->user->isGuest ? 'data-toggle="modal" data-target="#openUser"' : '';
/**
 * @var $races []
 * @var $showMore bool
 */
?>
<div class="search-container">
    <?= frontend\widgets\searchRacesPanel\SearchRacesPanel::widget(); ?>
</div>
<div class="container">
    <div class="pull-left">
        <?php  ?>
        <h1 class="m-t-3 m-b-3">Календарь соревнований по <?= \sport\models\Sport::getCurrentSportLabel('дательный');?>
            <?= \sport\models\Sport::getCondition()?>
        </h1>
    </div>
    <div class="clearfix"></div>
    <?php //\yii\helpers\VarDumper::dump($_GET);die();?>
    <?php if (($_GET['sport']=='triathlon')){?>
    <a href="http://tyrrussia.ru/?utm_source=trirussia&utm_medium=banner&utm_term=triathlon&utm_campaign=triathlon-sponsorship" class="no-underline" target="_blank">
        <div class="tyr-wrapper">
            <div class="tyr-container">
                <h4 class="m-t-0 m-b-0">TYR — спонсор лучших мировых триатлетов и рубрики «Триатлон» на TriRussia.ru </h4>
            </div>
        </div>
    </a>
    <?php }?>
    <div class="card card-block">
	    <div class="pull-left">
			<div class="form-group m-b-0">
	            <select
	                    class="c-select small sort-select"
	                data-popular="<?= \yii\helpers\Url::current(['sort'=>'popular']);?>"
	                <?php $sort = isset($_GET['sort']) ? $_GET['sort'] : null; ?>
	                <?php unset($_GET['sort']); ?>
	                data-date="<?= \yii\helpers\Url::current();?>"
	                <?php $_GET['sort'] = $sort ? $sort : null; ?>
	                value="<?= !empty($_GET['sort']) ? $_GET['sort'] : ''?>"
	            >
	                <option value="date">По дате</option>
	                <option value="popular" <?= !empty($_GET['sort']) && $_GET['sort'] == 'popular' ? 'selected' : ''?>>По популярности</option>
	            </select>
			</div>
		</div>
        <div class="pull-right">
            <button class="btn btn-sm btn-secondary" id="option1"><i class="fa fa-th" aria-hidden="true"></i></button>
            <button class="btn btn-sm btn-secondary" id="option2"><i class="fa fa-list" aria-hidden="true"></i></button>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="row" id="card">
	    <?php if (empty($races)) { ?>
	        <p class="text-xs-center m-t-2 m-b-2">К сожалению, нет результатов. Посмотрите <a href="/" class="underline">все старты</a>.</p>
	    <?php } ?>
        <ul class="flex-container">
            <?php /** @var $race \race\models\Race */ ?>
            <?php foreach ($races as $race) {?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <li class="flex-item">
                        <div class="card">
                            <div class="card-block border-<?= $race->getSportClass(); ?>">
                                <div class="pull-left">
                                    <h6 class="sport-caption <?= $race->getSportClass(); ?>"><?= $race->sport->label; ?></h6>
                                </div>
                                <div class="pull-right">
                                    <h6 class="date-caption grey"><?= $race->getDateRepresentation(); ?></h6>
                                </div>
                                <div class="clearfix"></div>
                                <h4 class="card-title">
                                    <?php if ($race->isJoined()) { ?>
                                        <span
                                            class="span-join"
                                            title="Вы участвуете"
                                            data-message-joined="Вы участвуете"
                                            data-message-will="Нажмите, чтобы добавить в календарь"
                                        >
                                    <i
                                        <?= $quest; ?>
                                        class="fa gold fa-star grey i-will-go already-joined"
                                        data-message="will"
                                        aria-hidden="true"
                                        data-id="<?= $race->id; ?>"
                                        data-url="<?= WillGo::dismissUrl(); ?>"
                                    ></i>
                                    <i
                                        <?= $quest; ?>
                                        class="fa fa-star-o grey i-will-go will-join hidden"
                                        aria-hidden="true"
                                        data-message="joined"
                                        data-id="<?= $race->id; ?>"
                                        data-url="<?= WillGo::joinUrl(); ?>"
                                    ></i>
                                </span>
                                    <?php } else { ?>
                                        <span
                                            class="span-join"
                                            title="Нажмите, чтобы добавить в календарь"
                                            data-message-joined="Вы участвуете"
                                            data-message-will="Нажмите, чтобы добавить в календарь"
                                        >
                                            <i
                                                <?= $quest; ?>
                                                class="fa gold fa-star grey i-will-go already-joined hidden"
                                                data-message="will"
                                                aria-hidden="true"
                                                data-id="<?= $race->id; ?>"
                                                data-url="<?= WillGo::dismissUrl(); ?>"
                                            ></i>
                                            <i
                                                <?= $quest; ?>
                                                class="fa fa-star-o grey i-will-go will-join"
                                                aria-hidden="joined"
                                                data-message="will"
                                                data-id="<?= $race->id; ?>"
                                                data-url="<?= WillGo::joinUrl(); ?>"
                                            ></i>
                                        </span>
                                    <?php } ?>
                                    <a href="<?= $race->getViewUrl(); ?>" class="underline-black">
                                        <?= $race->label; ?>
                                    </a>
                                </h4>
                                <p class="card-text"><?= $race->promo; ?></p>
                                <a href="<?= $race->getViewUrl(); ?>" class="btn btn-secondary btn-sm">Узнайте больше</a>
                            </div>
                        </div>
                    </li>
                </div>
            <?php } ?>
        </ul>
    </div>

    <div class="card card-block" id="list">
        <table class="table table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Дата</th>
                <th>Название</th>
                <th>Город</th>
                <th>Дистанция</th>
                <th>Организатор</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($races)) { ?>
                <p><strong>Нет результатов</strong></p>
            <?php } ?>
            <?php /** @var $races \race\models\Race */ ?>
            <?php foreach ($races as $race) {?>
                <tr>
                    <td>
                        <?php if ($race->isJoined()) { ?>
                            <span
                                class="span-join"
                                title="Вы участвуете"
                                data-message-joined="Вы участвуете"
                                data-message-will="Нажмите, чтобы добавить в календарь"
                            >
                                <i
                                    <?= $quest; ?>
                                    class="fa gold fa-star grey i-will-go already-joined"
                                    data-message="will"
                                    aria-hidden="true"
                                    data-id="<?= $race->id; ?>"
                                    data-url="<?= WillGo::dismissUrl(); ?>"
                                ></i>
                                <i
                                    <?= $quest; ?>
                                    class="fa fa-star-o grey i-will-go will-join hidden"
                                    aria-hidden="true"
                                    data-message="joined"
                                    data-id="<?= $race->id; ?>"
                                    data-url="<?= WillGo::joinUrl(); ?>"
                                ></i>
                            </span>
                        <?php } else { ?>   
                            <span
                                class="span-join"
                                title="Нажмите, чтобы добавить в календарь"
                                data-message-joined="Вы участвуете"
                                data-message-will="Нажмите, чтобы добавить в календарь"
                            >
                                <i
                                    <?= $quest; ?>
                                    class="fa gold fa-star grey i-will-go already-joined hidden"
                                    data-message="will"
                                    aria-hidden="true"
                                    data-id="<?= $race->id; ?>"
                                    data-url="<?= WillGo::dismissUrl(); ?>"
                                ></i>
                                <i
                                    <?= $quest; ?>
                                    class="fa fa-star-o grey i-will-go will-join"
                                    aria-hidden="true"
                                    data-message="joined"
                                    data-id="<?= $race->id; ?>"
                                    data-url="<?= WillGo::joinUrl(); ?>"
                                ></i>
                            </span>
                        <?php } ?>

                    </td>
                    <td><?=  date('d.m.Y', strtotime($race->start_date)); ?></td>
                    <td>
	                    <a href="#" data-toggle="tooltip" data-placement="left" class="no-underline" title="<?= $race->sport->label; ?>">
                            <i class="fa fa-circle <?= $race->getSportClass();?>"></i>
                        </a>&nbsp;<a href="<?= $race->getViewUrl(); ?>" class="underline"><?= $race->label; ?></a>
                    </td>
                    <td><?= $race->region ?></td>
                    <td><?= $race->getDistancesRepresentation(); ?></td>
                    <td><?= $race->organizer->label; ?><td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <?php if ($showMore) { ?>
        <div class="block block-more-races block-more-races-sport ">
            <button
                type="submit"
                data-lock="0"
                data-url="<?= \race\models\Race::getMoreRacesUrl();?>"
                data-target="<?= \race\models\Race::getMoreRacesTarget();?>"
                data-target-list="<?= \race\models\Race::getMoreRacesTargetList();?>"
                data-render-type="<?= \race\models\Race::getMoreRacesRenderType();?>"
                data-sort="<?= isset($_GET['sort']) ? $_GET['sort'] : null; ?>"
                class="btn btn-primary more-races"
                data-sport="<?= $_GET['sport']; ?>"
            >
                Загрузить еще соревнования
            </button>
        </div>
    <?php } ?>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card">
                <?= \frontend\widgets\allRaces\AllRaces::widget() ?>
            </div>
            <div class="race-block-container">
                <?= \frontend\widgets\mostPopularSportRaces\MostPopularSportRaces::widget(); ?>
            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sidebar">
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