<?php
use yii\helpers\Url;

/**
 * @var $races []
 */
?>
<div class="card-block border-run">
    <h4>
	    Посмотрите другие соревнования по <?= \sport\models\Sport::getCurrentSportLabel('дательный');?>:
    </h4>
    <ul class="list-unstyled m-t-1">
        <?php /** @var $race \race\models\Race */?>
        <?php foreach ( $races as $race ) { ?>
            <li>
                <span class="text-muted small"><?=  date('d.m.Y', strtotime($race->start_date)); ?></span>&nbsp;&nbsp;
                <a href="<?= Url::to(['/race/default/view', 'url' => $race->url,]) ?>" class="underline-black">
                    <?= $race->label; ?>
                </a>
            </li>
        <?php } ?>
    </ul>

    <ul class="list-inline m-t-1 m-b-0">
        <li class="list-inline-item m-r-2">
            <a href="<?= Url::to(['/', 'sport' => $this->context->model->sport->url, 'country' => 'Россия']); ?>" class="underline small">Все соревнования в стране <?= $race->country; ?> по <?= \sport\models\Sport::getCurrentSportLabel('дательный');?></a>
        </li>
        <li class="list-inline-item m-r-2">
            <a href="<?= Url::to(['/', 'sport' => $this->context->model->sport->url])?>" class="underline small">Все соревнования в мире по <?= \sport\models\Sport::getCurrentSportLabel('дательный');?></a>
        </li>
    </ul>
</div>