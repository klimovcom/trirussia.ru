<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 8/14/16
 * Time: 11:17 PM
 */
$racesByMonths = \race\models\Race::getAllRacesByMonths(date('Y-m'), date('Y-m', strtotime("+12 month")));

?>

    <div class="card-block">
        <h4 class="card-title m-b-0">Все соревнования</h4>
        <hr>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <h6>По месяцам</h6>
                <ul class="list-unstyled">
                    <li>
                        <small>В <?= date('Y'); ?> году</small>
                    </li>

                    <?php $printedNewYear = 0; ?>
                    <?php for($i=0; $i < 12; $i++){?>
                        <?php if (empty($racesByMonths[date('Y-m', strtotime("+$i month"))])) continue;?>

                        <?php if ((date('Y', strtotime("+$i month")) != date('Y')) && !$printedNewYear++) { ?>
                            <li>
                                <small>В <?= date('Y', strtotime("+$i month")); ?> году</small>
                            </li>
                        <?php } ?>

                        <li class="leftbar-small">
                            <a href="#" class="underline">
                                <?=  $this->context->getMonths(1*date('m', strtotime("+$i month"))); ?>
                            </a>
                        <span class="race-count">
                            <small>
                                <?= $racesByMonths[date('Y-m', strtotime("+$i month"))]; ?>
                            </small>
                        </span>
                        </li>
                    <?php }?>

                </ul>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <h6>По виду спорта</h6>
                <ul class="list-unstyled">
                    <li class="leftbar-small"><a href="#" class="underline">Триатлон</a><span class="race-count"><small>
                                12
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Бег</a><span class="race-count"><small>12
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Плавание</a><span class="race-count"><small>
                                12
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Велоспорт</a><span class="race-count"><small>
                                2
                            </small></span></li>
                </ul>
                <h6>По дистанции</h6>
                <ul class="list-unstyled">
                    <li>
                        <small>Триатлон</small>
                    </li>
                    <li class="leftbar-small"><a href="#" class="underline">Спринт</a><span class="race-count"><small>
                                11
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Олимпийская дистанция</a><span
                            class="race-count"><small>21</small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Half-Ironman</a><span class="race-count"><small>
                                33
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Ironman</a><span class="race-count"><small>
                                0
                            </small></span></li>
                    <li class="m-t-1">
                        <small>Бег</small>
                    </li>
                    <li class="leftbar-small"><a href="#" class="underline">5 км</a><span class="race-count"><small>11
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">10 км</a><span class="race-count"><small>
                                21
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Полумарафон</a><span class="race-count"><small>
                                33
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Марафон</a><span class="race-count"><small>
                                0
                            </small></span></li>
                </ul>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <h6>По странам</h6>
                <ul class="list-unstyled">
                    <li class="leftbar-small"><a href="#" class="underline">Россия</a><span class="race-count"><small>
                                12
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Германия</a><span class="race-count"><small>
                                10
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Беларусь</a><span class="race-count"><small>
                                9
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Швейцария</a><span class="race-count"><small>
                                8
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Италия</a><span class="race-count"><small>
                                7
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Люксембург</a><span class="race-count"><small>
                                1
                            </small></span></li>
                </ul>
                <h6>По организаторам</h6>
                <ul class="list-unstyled">
                    <li class="leftbar-small"><a href="#" class="underline">Ironstar</a><span class="race-count"><small>
                                12
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Ironman</a><span class="race-count"><small>
                                10
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">A1 Triathlon</a><span class="race-count"><small>
                                9
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Titan</a><span class="race-count"><small>8
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">New Runners</a><span class="race-count"><small>
                                7
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">3Sport</a><span class="race-count"><small>
                                1
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Выборгмен</a><span class="race-count"><small>
                                8
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Challenge</a><span class="race-count"><small>
                                8
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">Шри Чин Мой</a><span class="race-count"><small>
                                8
                            </small></span></li>
                    <li class="leftbar-small"><a href="#" class="underline">МБК</a><span class="race-count"><small>8
                            </small></span></li>
                </ul>
            </div>
        </div>
    </div>