<?php
/**
 * @var $pastRaces []
 */
?>

<div class="pull-left"><h4 class="PTSerif"><i>Прошедшие соревнования</i></h4></div>
<div class="pull-right"><a href="/race/add" class="btn btn-secondary btn-sm hidden-sm-down">Добавить соревнование</a></div>
<div class="clearfix"></div>
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
                    <i class="fa fa-star gold" aria-hidden="true"></i> <span class="small"><sup><?= number_format(round($race->rating, 2), 2, '.', '');?></sup></span>
                <?php endif;?>
            </h5>
            <p><?= $race->promo ?></p>
			<span class="text-muted small"><?= $race->getDateRepresentation(); ?></span>
        </div>
    <?php } ?>
</div>