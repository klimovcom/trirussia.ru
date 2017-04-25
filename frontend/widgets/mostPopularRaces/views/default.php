<?php
use yii\helpers\Url;
use metalguardian\fileProcessor\helpers\FPM;
/**
 * @var $races []
 */
?>

<div class="pull-left"><h4 class="PTSerif"><i>Самые ожидаемые соревнования</i></h4></div>
<div class="pull-right"><a href="/race/add" class="btn btn-primary-outline btn-sm hidden-sm-down">Добавить соревнование</a></div>
<div class="clearfix"></div>
<div class="row">
    <?php /** @var $race \race\models\Race */?>
   <?php foreach ($races as $race) {?>
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 m-t-1">
           <a href="<?= $race->getViewUrl(); ?>">
               <div class="embed-responsive embed-responsive-16by9">
                   <img alt="<?= $race->label; ?>" class="most-wanted embed-responsive-item lazy" data-original="<?= FPM::originalSrc($race->main_image_id); ?>">
               </div>
           </a>
           <h5 class="m-t-1">
               <a href="<?= $race->getViewUrl(); ?>" class="underline-black">
                   <?= $race->label; ?>
               </a>
           </h5>
           <p>
               <?= $race->promo; ?>
           </p>
           <span class="text-muted small"><?= $race->getDateRepresentation(); ?>,
                   <?= $race->region; ?>
           </span>
       </div>
    <?php } ?>
</div>
