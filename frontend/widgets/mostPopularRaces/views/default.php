<?php
use yii\helpers\Url;
use metalguardian\fileProcessor\helpers\FPM;
/**
 * @var $races []
 */
?>

<h4 class="PTSerif"><i>Самые ожидаемые соревнования</i></h4>
<div class="row">
    <?php /** @var $race \race\models\Race */?>
   <?php foreach ($races as $race) {?>
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 m-t-1">
           <a href="<?= Url::to(['/race/default/view', 'url' => $race->url,]) ?>">
               <img src="<?= FPM::originalSrc($race->main_image_id);?>" class="img-fluid most-wanted">
           </a>
           <h5 class="m-t-1">
               <a href="<?= Url::to(['/race/default/view', 'url' => $race->url,]) ?>" class="no-underline">
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