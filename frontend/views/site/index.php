<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
/** @var $mainRaces [] */
/** @var $secondaryRaces [] */
/** @var $showMore boolean */

$this->title = 'My Yii Application';
?>
<div class="container">
    <div class="race-block-container">
        <?= frontend\widgets\pastRaces\PastRaces::widget(); ?>
    </div>
    <div class="row m-t-3 m-b-3">
        <div class="col-lg-4 col-xl-4">
            <img src="/img/arr.png">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <h1>Ближайшие соревнования по
                <a href="<?= Url::to(['/', 'sport' => 'triathlon',]) ?>" class="highlight-yellow">триатлону</a>,
                <a href="<?= Url::to(['/', 'sport' => 'run',]) ?>" class="underline-black">бегу</a>,
                <a href="<?= Url::to(['/', 'sport' => 'swim',]) ?>" class="underline-black">плаванию</a> и
                <a href="<?= Url::to(['/', 'sport' => 'bike',]) ?>" class="underline-black">велоспорту</a>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="grid">
            <?php /** @var $race \race\models\Race */ ?>
            <?php foreach ($mainRaces as $race) { ?>
                    <?= $this->render('_card.php', ['race' => $race, ]); ?>
            <?php } ?>
        </div>
    </div>
    <div class="race-block-container">
       <?= \frontend\widgets\mostPopularRaces\MostPopularRaces::widget(); ?>
    </div>
    <div class="row">
        <div class="grid">
            <?php /** @var $race \race\models\Race */ ?>
            <?php foreach ($secondaryRaces as $race) { ?>
                    <?= $this->render('_card.php', ['race' => $race, ]); ?>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="grid">
            <?php /** @var $race \race\models\Race */ ?>
            <?php foreach ($lastRaces as $race) { ?>
                    <?= $this->render('_card.php', ['race' => $race, ]); ?>
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
                data-sport="<?= isset($_GET['sport']) ? $_GET['sport'] : '';?>"
                class="btn btn-success btn-lg more-races"
            >
                <strong>Загрузить еще соревнования</strong>
            </button>
        </div>
    <?php } ?>
</div>