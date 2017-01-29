<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
/** @var $mainRaces [] */
/** @var $secondaryRaces [] */
/** @var $showMore boolean */
/** @var $promos [] */

$this->title = 'TriRussia.ru — Главный сайт о триатлоне';
?>
<div class="container">
    <div class="race-block-container">
        <?= frontend\widgets\pastRaces\PastRaces::widget(); ?>
    </div>

	<a href="http://www.trirussia.ru/race/Skigrom-bitza-30k-2017">
		<div class="race-vote-gradient">
			<div class="row">
				<div class="col-xl-8">
					<h3>Были на SkiGrom 30K в Битце?</h3>
					<h3 class="PTSerif m-a-0"><i>Понравилось? — Скажите!</i></h3>
				</div>
				<div class="col-xl-4 text-xs-right">
					<h2 class="m-a-0">
						<i class="fa fa-star gold" aria-hidden="true"></i>
						5.00
					</h2>
				</div>
			</div>
		</div>
	</a>

    <div class="row m-t-3 m-b-3">
        <div class="col-lg-4 col-xl-4">
            <a href="<?= Url::to('/' . 'triathlon'/*, 'sport' => 'triathlon',*/) ?>"><img src="/img/arr.png"></a>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <h1>Ближайшие соревнования по
                <a href="<?= Url::to('/' . 'triathlon'/*, 'sport' => 'triathlon',*/) ?>" class="highlight-yellow">триатлону</a>,
                <a href="<?= Url::to('/' . 'run'/*, 'sport' => 'run',*/) ?>" class="underline-black">бегу</a>,
                <a href="<?= Url::to('/' . 'swim'/*, 'sport' => 'swim',*/) ?>" class="underline-black">плаванию</a> и
                <a href="<?= Url::to('/' . 'bike'/*, 'sport' => 'bike',*/) ?>" class="underline-black">велоспорту</a>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="grid">
            <?php $count = 0; ?>
            <?php /** @var $race \race\models\Race */ ?>
            <?php foreach ($mainRaces as $race) { ?>
                <?= $this->render('_card.php', ['race' => $race, ]); ?>

                <?php if ( ( ++$count % 8 == 0 || $count % 9 == 0 ) && !empty($promos)) { ?>
                    <?= $this->render('_featured.php', ['promo' => array_pop($promos), ]); ?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="race-block-container">
        <?= \frontend\widgets\mostPopularRaces\MostPopularRaces::widget(); ?>
    </div>
    <div class="row">
        <div class="grid">
            <?php $count = 0; ?>
            <?php /** @var $race \race\models\Race */ ?>
            <?php foreach ($secondaryRaces as $race) { ?>
                <?= $this->render('_card.php', ['race' => $race, ]); ?>

                <?php if ( ( ++$count % 8 == 0 || $count % 9 == 0 ) && !empty($promos)) { ?>
                    <?= $this->render('_featured.php', ['promo' => array_pop($promos), ]); ?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

    <?= frontend\widgets\news\News::widget(); ?>

    <div class="row">
        <div class="grid">
            <?php $count = 0; ?>
            <?php /** @var $race \race\models\Race */ ?>
            <?php foreach ($lastRaces as $race) { ?>
                <?= $this->render('_card.php', ['race' => $race, ]); ?>

                <?php if ( ( ++$count % 8 == 0 || $count % 9 == 0 ) && !empty($promos)) { ?>
                    <?= $this->render('_featured.php', ['promo' => array_pop($promos), ]); ?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="race-block-container hidden-sm-down">
        <h4 class="PTSerif"><i>Будьте в курсе лучших соревнований</i></h4>
        <div class="subscribe-line border-line" id="subscribe">
            <div class="container">
                <div class="row">
                    <form class=""
                          action="//trirussia.us4.list-manage.com/subscribe/post?u=4732804bad337fc1dc84138d5&amp;id=4a7ae4d6e6"
                          method="post" target="_blank" novalidate="">
                        <div class="col-md-8">
                            <div class="form-group m-b-0">
                                <input type="text" name="EMAIL" id="mce-EMAIL" class="form-control"
                                       placeholder="Введите ваш email" required="">
                            </div>
                        </div>
                        <div class="col-md-4 text-xs-right">
                            <div style="position: absolute; left: -5000px;"><input type="text"
                                                                                   name="b_4732804bad337fc1dc84138d5_4a7ae4d6e6"
                                                                                   tabindex="-1" value=""></div>
                            <button type="submit" class="btn btn-secondary btn-lg">Узнать раньше всех</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php if ($showMore) { ?>
        <div class="block block-more-races">
            <button
                type="submit"
                data-lock="0"
                data-url="<?= \race\models\Race::getMoreRacesUrl();?>"
                data-target="<?= \race\models\Race::getMoreRacesIndexTarget();?>"
                data-render-type="<?= \race\models\Race::getMoreRacesIndexRenderType();?>"
                data-sport="<?= isset($_GET['sport']) ? $_GET['sport'] : '';?>"
                class="btn btn-primary more-races"
            >
                Загрузить ещё соревнования
            </button>
        </div>
    <?php } ?>
</div>