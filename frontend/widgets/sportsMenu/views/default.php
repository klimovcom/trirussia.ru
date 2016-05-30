<?php
/**
 * @var $sports []
 */
?>

<ul class="nav navbar-nav hidden-sm-down">
    <li class="nav-item">
        <i class="fa fa-bars menu-trigger fa-2x" aria-hidden="true"></i>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-logo" href="/">TriRussia.ru</a>
    </li>
    <?php foreach ($sports as $sport) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/', 'sport' => $sport->url, ])?>"><?= $sport->label; ?></a>
        </li>
    <?php } ?>
</ul>