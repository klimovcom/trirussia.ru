<?php
use yii\helpers\Url;

/**
 * @var $races []
 */
?>
<div class="card-block border-run">
    <h4>Ещё <a href="#" class="underline-black">соревнования по бегу</a></h4>
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
        <li class="list-inline-item m-r-2"><a href="#" class="underline small">Все соревнования в России</a></li>
        <li class="list-inline-item m-r-2"><a href="#" class="underline small">Соревнования по бегу в мире</a></li>
    </ul>
</div>