<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="container">
	<h1 class="m-t-3 m-b-3 text-xs-center">Опаньки: <?= Html::encode($this->title) ?></h1>
	<div class="alert alert-danger text-xs-center">
		<?= nl2br(Html::encode($message)) ?>
	</div>
	<p class="text-xs-center m-t-2">
		Видимо, что-то пошло не так. Но вы не расстраивайтесь: перейдите на <a href="/" class="underline">главную страницу</a> или воспользуйтесь нашим удобным меню сверху или снизу. На сайте вы найдёте сотни лучших соревнований со всего мира. Если ошибка будет повторяться, то обязательно напишите нам на <a href="mailto:artem@klimov.com" class="underline">artem@klimov.com</a>. Удачных стартов!
	</p>
</div>