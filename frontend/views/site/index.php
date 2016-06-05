<?php

/* @var $this yii\web\View */
/** @var $mainRaces [] */
/** @var $secondaryRaces [] */

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
            <h1>Ближайшие соревнования по <a href="#" class="highlight-yellow">триатлону</a>, <a href="#"
                                                                                                 class="underline-black">бегу</a>,
                <a href="#" class="underline-black">плаванию</a> и <a href="#" class="underline-black">велоспорту</a>
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
    <div class="news-block-container">
        <h4 class="PTSerif"><i>Новости из <a href="#" class="underline">журнала TriRussia.ru </a></i></h4>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <hr>
                <h6 class="magazine-caption news">Новости</h6>
                <h2><a href="#" class="no-underline">Заголовок для новостей, который может быть коротким или очень
                        длинным</a></h2>
                <span class="text-muted small">Новая статья</span>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="row">
                    <ul class="flex-container">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <li class="flex-item">
                                <hr>
                                <h6 class="magazine-caption news">Новости</h6>
                                <h5><a href="#" class="no-underline">Отчет о главном мероприятии лета</a></h5>
                                <span class="text-muted small">5 дней назад</span>
                            </li>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <li class="flex-item">
                                <hr>
                                <h6 class="magazine-caption news">Новости</h6>
                                <h5><a href="#" class="no-underline">Как быстрее ехать в гору: сидя или танцуя. Отвечает
                                        Ильнур Закарин.</a></h5>
                                <span class="text-muted small">5 дней назад</span>
                            </li>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <li class="flex-item">
                                <hr>
                                <h6 class="magazine-caption news">Новости</h6>
                                <h5><a href="#" class="no-underline">Как бегать марафоны без бананов, но во дворе такая
                                        погода и где Валера?</a></h5>
                                <span class="text-muted small">5 дней назад</span>
                            </li>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <li class="flex-item">
                                <hr>
                                <h6 class="magazine-caption news">Новости</h6>
                                <h5><a href="#" class="no-underline">Как бегать марафоны без бананов, но во дворе такая
                                        погода и где Валера?</a></h5>
                                <span class="text-muted small">5 дней назад</span>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
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
</div>