<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 8/14/16
 * Time: 11:17 PM
 */
$racesByMonths = \race\models\Race::getAllRacesByMonths(date('Y-m'), date('Y-m', strtotime("+12 month")));
$racesBySports = \race\models\Race::getAllRacesBySport(date('Y-m'));
$racesByCountries = \race\models\Race::getAllRacesByCountries(date('Y-m'));
$racesByOrganizers = \race\models\Race::getAllRacesByOrganizers(date('Y-m'));
$racesByDistancesRun = \race\models\Race::getCalculatedAllRacesBySportDistances('Бег');
$racesByDistancesTriathlon = \race\models\Race::getCalculatedAllRacesBySportDistances('Триатлон');
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
                    <?php foreach ($racesBySports as $sport => $racesCount) {?>
                        <li class="leftbar-small">
                            <a href="#" class="underline">
                                <?= $sport; ?>
                            </a>
                            <span class="race-count">
                                <small>
                                    <?= $racesCount; ?>
                                </small>
                            </span>
                        </li>
                    <?php }?>
                </ul>
                <h6>По дистанции</h6>
                <ul class="list-unstyled">
                    <li>
                        <small>Триатлон</small>
                    </li>
                    <?php foreach ($racesByDistancesTriathlon as $distance => $amount) { ?>
                        <li class="leftbar-small">
                            <a href="#" class="underline"><?= $distance;?></a>
                        <span class="race-count">
                            <small><?= $amount;?></small>
                        </span>
                        </li>
                    <?php } ?>
                    <li class="m-t-1">
                        <small>Бег</small>
                    </li>
                    <?php foreach ($racesByDistancesTriathlon as $distance => $amount) { ?>
                        <li class="leftbar-small">
                            <a href="#" class="underline"><?= $distance;?></a>
                        <span class="race-count">
                            <small><?= $amount;?></small>
                        </span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <h6>По странам</h6>
                <ul class="list-unstyled">
                    <?php foreach ($racesByCountries as $country=>$racesCount) { ?>
                        <li class="leftbar-small">
                            <a href="#" class="underline"><?= $country; ?></a>
                        <span class="race-count">
                            <small>
                                <?= $racesCount; ?>
                            </small>
                        </span>
                        </li>
                    <?php } ?>
                </ul>
                <h6>По организаторам</h6>
                <ul class="list-unstyled">
                    <?php foreach ($racesByOrganizers as $organizer=>$racesCount) {?>
                        <li class="leftbar-small">
                            <a href="#" class="underline">
                                <?= $organizer;?>
                            </a>
                        <span class="race-count">
                            <small>
                                <?= $racesCount;?>
                            </small>
                        </span>
                        </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>