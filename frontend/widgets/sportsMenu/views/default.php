<nav class="nav nav-inline c-nav">
	<div class="container">
		<div class="pull-left">
			<ul class="list-inline">
				<li class="nav-item"><i class="fa fa-bars fa-lg nav-hamb menu-trigger" aria-hidden="true"></i></li>
				<li class="nav-item m-l-2 m-t-1 m-b-1 m-r-1"><a href="/"><img src="/img/logo.png"></a></li>
				<?php foreach ($sports as $sport) { ?>
					<li class="nav-item"><a href="<?= \yii\helpers\Url::to(['/', 'sport' => $sport->url, ])?>" class="nav-link"><?= $sport->label; ?></a></li>
				<?php } ?>
				<li class="nav-item"><a href="/magazine" class="nav-link">Журнал</a></li>
				<li class="nav-item"><a href="/shop" class="nav-link">Магазин</a></li>
			</ul>
		</div>
		<div class="pull-right">
			<button class="btn btn-primary btn-sm m-t-1" data-toggle="modal" data-target="#openUser">Войти</button>
		</div>
		<div class="clearfix"></div>
	</div>
</nav>