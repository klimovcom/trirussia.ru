<!DOCTYPE HTML>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name='yandex-verification' content='5c6a73e6a139de67' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="TriRussia.ru">
		<meta name="keywords" content="Триатлон, бег, велоспорт, плавание, тренировки, подготовка к триатлону, занятия по бегу, подготовка к полумарафону">
		<meta name="description" content="Вся информация о спортивных клубах и тренировках по триатлону, бегу, плаванию и велоспорту.">
		<?php include "meta.php"; ?>
		<title>Тренировки по триатлону, бегу, плаванию и велоспорту на TriRussia.ru</title>
		<?php include "head.php"; ?>
	</head>
	<body>
		<?php include "menu.php"; ?>
		<div class="container">
			<h1 class="m-t-3 m-b-3">Добавьте новое соревнование</h1>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
					<div class="card card-block">
						<h4>Требования</h4>
						<ul class="m-b-2">
							<li>Пишите без ошибок</li>
							<li>Все поля обязательны для заполнения</li>
							<li>В названии соревнования не указывайте даты</li>
							<li>В один день может быть несколько соревнований</li>
							<li>Давайте полное описание</li>
							<li>Ссылки <strong>запрещены</strong></li>
						</ul>
						<hr>
						<form class="m-t-3">
							<div class="form-group row">
								<label class="col-sm-4 form-control-label">Название</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="title" maxlength="50" required>
									<small class="text-muted" id="title-characters"></small>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 form-control-label">Дата старта</label>
								<div class="col-sm-8">
									<input class="form-control datepicker" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 form-control-label">Время старта</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 form-control-label">Страна</label>
								<div class="col-sm-8">
									<select class="c-select select2">
										<option>Россия</option>
										<option>Абхазия</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 form-control-label">Город</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 form-control-label">Место</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 form-control-label">Вид спорта</label>
								<div class="col-sm-8">
									<select class="c-select">
										<option>Триатлон</option>
										<option>Бег</option>
										<option>Плавание</option>
										<option>Велоспорт</option>
										<option>Дуатлон</option>
										<option>Лыжи</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 form-control-label">Дистанция</label>
								<div class="col-sm-8">
									<div class="checkbox">
										<label>
											<input type="checkbox"> Суперспринт
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox"> Спринт
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox"> Олимпийская дистанция
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox"> Half-Ironman (половинка)
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox"> Ironman (полная дистанция)
										</label>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 form-control-label">Стоимость участия</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" required>
								</div>
								<div class="col-sm-5">
									<div class="btn-group" role="group" data-toggle="buttons">
										<label class="btn btn-secondary">
											<input type="radio">Рублей
										</label>
										<label class="btn btn-secondary">
											<input type="radio">Долларов
										</label>
										<label class="btn btn-secondary">
											<input type="radio">Евро
										</label>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 form-control-label">Организатор</label>
								<div class="col-sm-8">
									<select class="c-select select2">
										<option>Ironman</option>
										<option>Ironstar</option>
										<option>Titan</option>
										<option>Moscow River Runners</option>
										<option>3Sport</option>
										<option>New Runners</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 form-control-label">Ссылка на официальный сайт</label>
								<div class="col-sm-8">
									<input type="url" class="form-control" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 form-control-label">Номер из ссылки на мероприятие в Фейбсуке</label>
								<div class="col-sm-8">
									<input type="url" class="form-control" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="comment" class="col-sm-4 control-label">Краткое описание:<br>(не более 100 знаков)</label>
								<div class="col-sm-8">
									<textarea class="form-control" id="excerpt" rows="3" maxlength="100" required></textarea>
									<small class="text-muted" id="excerpt-characters"></small>
								</div>
							</div>
							<div class="form-group row">
								<label for="comment" class="col-sm-4 control-label">Описание:</label>
								<div class="col-sm-8">
									<textarea class="form-control" rows="6" required></textarea>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sidebar">
					<div class="card card-block">
						<h4>Пример заполнения</h4>
						<ul class="list-unstyled">
							<li><span class="text-muted">Название:</span> <span class="PTSerif"><i>Московский марафон</i></span></li>
							<li><span class="text-muted">Дата старта:</span> <span class="PTSerif"><i>25.09.2016</i></span></li>
							<li><span class="text-muted">Время старта:</span> <span class="PTSerif"><i>9:10</i></span></li>
							<li><span class="text-muted">Страна:</span> <span class="PTSerif"><i>Росссия</i></span></li>
							<li><span class="text-muted">Город:</span> <span class="PTSerif"><i>Москва</i></span></li>
							<li><span class="text-muted">Место:</span> <span class="PTSerif"><i>Лужники</i></span></li>
							<li><span class="text-muted">Вид спорта:</span> <span class="PTSerif"><i>Бег</i></span></li>
							<li><span class="text-muted">Дистанция:</span> <span class="PTSerif"><i>Марафон, 10 км</i></span></li>
							<li><span class="text-muted">Стоимость участия:</span> <span class="PTSerif"><i>1500 рублей</i></span></li>
							<li><span class="text-muted">Организатор:</span> <span class="PTSerif"><i>Московский марафон</i></span></li>
							<li><span class="text-muted">Ссылка на официальный сайт:</span> <span class="PTSerif"><i>http://moscowmarathon.org/ru/</i></span></li>
							<li><span class="text-muted">Номер из ссылки на мероприятие в Фейбсуке:</span> <span class="PTSerif"><i>1562344640750526</i></span></li>
							<li><span class="text-muted">Краткое описание:</span> <span class="PTSerif"><i>Главное беговое событие города. Ещё больше участников со всего мира и прекрасная экскурсия по городу</i></span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php include "leftsidemenu.php"; ?>
		<?php include "footer.php"; ?>
		<?php include "js.php"; ?>
		<script>
			$(document).ready(function(){
				$(".select2").select2({
					theme: "bootstrap"
				});
				$("#excerpt").keyup(function() {
				    var cs = "Осталось знаков: " + (100 - $(this).val().length);
				    $("#excerpt-characters").text(cs);
				});
				$("#title").keyup(function() {
				    var cs = "Осталось знаков: " + (50 - $(this).val().length);
				    $("#title-characters").text(cs);
				});
				
				$(".datepicker").datepicker({
					format: "dd.mm.yyyy",
					language: "ru",
					autoclose: true,
					startDate: "d",
					todayHighlight: true,
					
				});
			});
		</script>
	</body>
</html>