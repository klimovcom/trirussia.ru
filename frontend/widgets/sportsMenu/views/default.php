<?php
/**
 * @var $sports []
 */
?>
<ul class="list-inline">

	<li class="nav-item hidden-sm-down"><i class="fa fa-bars fa-lg nav-hamb menu-trigger" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-hidden="true"></i></li>
	<button class="navbar-toggler hidden-md-up" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false">
		<i class="fa fa-bars fa-lg"></i>
	</button>
	<li class="nav-item m-l-2 m-t-1 m-b-1 m-r-1"><a href="/"><img src="/img/logo.png"></a></li>
	<?php /** @var $sport \sport\models\Sport */?>
	<?php foreach ($sports as $sport) { ?>
		<li class="nav-item hidden-sm-down"><a href="<?= $sport->getViewUrl(); ?>" class="nav-link"><?= $sport->label; ?></a></li>
	<?php } ?>
 	<li class="nav-item hidden-sm-down"><a href="/magazine" class="nav-link">Журнал</a></li>
 	<li class="nav-item hidden-sm-down"><a href="/shop" class="nav-link">Магазин</a></li>
</ul>