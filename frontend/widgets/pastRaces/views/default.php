<?php
/**
 * @var $pastRaces []
 */
?>

<h4 class="PTSerif"><i>Прошедшие соревнования</i></h4>
<div class="row">
    <?php /** @var $race \race\models\Race */ ?>
    <?php foreach ($pastRaces as $race) {?>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <hr>
            <h6 class="sport-caption <?= $race->getSportClass(); ?>"><?= $race->sport->label; ?></h6>
            <h5>
                <a href="<?= $race->getViewUrl(); ?>" class="no-underline">
                    <?= $race->label; ?>
                </a>
                <?php if ($race->rating):?>
                    <i class="fa fa-star gold" aria-hidden="true"></i> <span class="small"><sup><?= round($race->rating, 2);?></sup></span>
                <?php endif;?>
            </h5>
            <p><?= $race->promo ?></p>
			<span class="text-muted small"><?= $race->getDateRepresentation(); ?></span>
        </div>
    <?php } ?>
</div>