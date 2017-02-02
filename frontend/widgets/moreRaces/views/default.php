<?php
use yii\helpers\Url;

/**
 * @var $races []
 */
?>
<div class="card-block border-run">
    <h4>
	    Посмотрите другие соревнования в категории <?= $this->context->model->sport->label; ?>:
    </h4>
    <ul class="list-unstyled m-t-1">
        <?php /** @var $race \race\models\Race */?>
        <?php foreach ( $races as $race ) { ?>
            <li>
                <span class="text-muted small"><?=  date('d.m.Y', strtotime($race->start_date)); ?></span>&nbsp;&nbsp;
                <a href="<?= $race->getViewUrl(); ?>" class="underline-black">
                    <?= $race->label; ?>
                </a>
            </li>
        <?php } ?>
    </ul>

    <ul class="list-inline m-t-1 m-b-0">
        <li class="list-inline-item m-r-2">
            <a href="<?= Url::to(['/site/sport', 'sport' => $model->sport->url, 'country' =>  $model->country]); ?>" class="underline small">Все соревнования в стране <?= $model->country; ?> в категории <?= $model->sport->label; ?></a>
        </li>
        <li class="list-inline-item m-r-2">
            <a href="<?= Url::to(['/site/sport', 'sport' => $model->sport->url])?>" class="underline small">Все соревнования в мире в категории <?= $model->sport->label; ?></a>
        </li>
    </ul>
</div>