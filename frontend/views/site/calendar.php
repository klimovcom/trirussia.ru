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
                                        <a href="<?= Url::to(['/race/default/view', 'url' => $race->url,]) ?>" class="underline-black"><?= $race->label; ?></a>
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
                                    <a href="<?= Url::to(['/race/default/view', 'url' => $race->url,]) ?>" class="underline">
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
                    <img src="https://s-media-cache-ak0.pinimg.com/736x/2d/82/a6/2d82a6a6be76603d79a263f05ee96ac8.jpg">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 hidden new-sidebar">
            <div class="ad-sidebar text-xs-center">
                <img src="https://s-media-cache-ak0.pinimg.com/736x/2d/82/a6/2d82a6a6be76603d79a263f05ee96ac8.jpg">
            </div>
        </div>
    </div>
</div>
