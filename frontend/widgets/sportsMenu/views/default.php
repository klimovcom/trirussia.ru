<?php
/**
 * @var $sports []
 */
?>
<ul class="list-inline">
	<li class="nav-item"><i class="fa fa-bars fa-lg nav-hamb menu-trigger" aria-hidden="true"></i></li>
	<li class="nav-item m-l-2 m-t-1 m-b-1 m-r-1"><a href="/"><img src="/img/logo.png"></a></li>
	<?php foreach ($sports as $sport) { ?>
		<li class="nav-item"><a href="<?= \yii\helpers\Url::to(['/', 'sport' => $sport->url, ])?>" class="nav-link"><?= $sport->label; ?></a></li>
	<?php } ?>
	<li class="nav-item"><a href="/magazine" class="nav-link">Журнал</a></li>
<!-- 	<li class="nav-item"><a href="/shop" class="nav-link">Магазин</a></li> -->
</ul>