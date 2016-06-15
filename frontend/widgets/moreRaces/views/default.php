<?php
use yii\helpers\Url;

/**
 * @var $races []
 */
?>
<div class="card-block border-<?= $race->getSportClass(); ?>">
    <h4>
	    <a href="#" class="underline-black"><?= $this->context->model->sport->label; ?></a> очень популярен. Посмотрите другие соревнования:
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
            <a href="<?= Url::to(['/', 'sport' => $this->context->model->sport->url, 'country' => 'Россия']); ?>" class="underline small">Все соревнования в стране <?= $race->country; ?> в категории <?= $this->context->model->sport->label; ?></a>
        </li>
        <li class="list-inline-item m-r-2">
            <a href="<?= Url::to(['/', 'sport' => $this->context->model->sport->url])?>" class="underline small">Все соревнования в мире в категории <?= $this->context->model->sport->label; ?></a>
        </li>
    </ul>
</div>