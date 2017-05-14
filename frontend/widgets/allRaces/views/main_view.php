<?php
/**
 * @var $racesByMonths
 * @var $racesBySports
 * @var $racesByCountries
 * @var $racesByOrganizers
 * @var $racesByDistancesRun
 * @var $racesByDistancesTriathlon
 * @var $sportModel
 */

if (!$sportModel)
    $sportUrl = 'search-races';
else
    $sportUrl = $sportModel->url;
?>
<div class="bg-inverse p-t-1">
    <div class="container">
        <h2>Найдите соревнование</h2>
        <p>Мы собрали все лучшие соревнования и рассортировали их так, чтобы вам было удобно.</p>
        <div class="row">
            <div class="col-xl-4">
                <h5 class="white">По месяцам</h5>
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
                            <?php $url = '/' . $sportUrl . '?date=' . date('Y-m-01', strtotime("+$i month"));?>
                            <a href="<?= $url; ?>" class="underline-white">
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
            <div class="col-xl-4">
                <h5 class="white">По виду спорта</h5>
                <ul class="list-unstyled">
                    <?php foreach ($racesBySports as $sport => $racesCount) {?>
                        <li class="leftbar-small">
                            <a href="<?= '/' . \sport\models\Sport::getSportUrls()[$sport]; ?>" class="underline-white">
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
                <h5 class="white">По дистанции</h5>
                <ul class="list-unstyled">
                    <li>
                        <small>Триатлон</small>
                    </li>
                    <?php foreach ($racesByDistancesTriathlon as $distance => $amount) { ?>
                        <li class="leftbar-small">
                            <?php $url = '/' .\sport\models\Sport::getSportUrls()['Триатлон'] . '?distance=' . urlencode($distance)?>
                            <a href="<?= $url; ?>" class="underline-white"><?= $distance;?></a>
                        <span class="race-count">
                            <small><?= $amount;?></small>
                        </span>
                        </li>
                    <?php } ?>
                    <li class="m-t-1">
                        <small>Бег</small>
                    </li>
                    <?php foreach ($racesByDistancesRun as $distance => $amount) { ?>
                        <li class="leftbar-small">
                            <?php $url = '/' .\sport\models\Sport::getSportUrls()['Бег'] . '?distance=' . urlencode($distance)?>
                            <a href="<?= $url; ?>" class="underline-white"><?= $distance;?></a>
                        <span class="race-count">
                            <small><?= $amount;?></small>
                        </span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-xl-4">
                <h5 class="white">По странам</h5>
                <ul class="list-unstyled">
                    <?php foreach ($racesByCountries as $country=>$racesCount) { ?>
                        <li class="leftbar-small">
                            <?php $url = '/' .$sportUrl . '?country=' . urlencode($country)?>
                            <a href="<?= $url; ?>" class="underline-white"><?= $country; ?></a>
                        <span class="race-count">
                            <small>
                                <?= $racesCount; ?>
                            </small>
                        </span>
                        </li>
                    <?php } ?>
                </ul>
                <h5 class="white">По организаторам</h5>
                <ul class="list-unstyled">
                    <?php foreach ($racesByOrganizers as $organizer=>$racesCount) {?>
                        <li class="leftbar-small">
                            <?php $url = '/' .$sportUrl . '?organizer=' . urlencode($organizer)?>
                            <a href="<?= $url; ?>" class="underline-white">
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
</div>