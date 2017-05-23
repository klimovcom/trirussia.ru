<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<p>
	<button class="btn btn-primary toggle-seo">Настройки СЕО для списка</button>
</p>
<div id="seo-form-widget" class="seo-form">

	<?php if ($isForm) : ?>
		<?php $form = ActiveForm::begin(['action' => \yii\helpers\Url::toRoute(['/seo/seo/model'])]); ?>
		<?= $form->field($seo, 'model_name')->hiddenInput()->label(false) ?>

		<?= $form->field($seo, 'model_id')->hiddenInput()->label(false) ?>

		<?= $form->field($seo, 'title')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($seo, 'keywords')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($seo, 'description')->textarea(['rows' => 6]) ?>

		<?= $form->field($seo, 'og_image_id')->fileInput() ?>

		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>

		<?php ActiveForm::end();

	elseif ($model && $model->isNewRecord) : ?>
		<div class="form-group">
			<?= Html::label($seo->getAttributeLabel('title'), 'seo-title', ['class' => 'control-label']) ?>
			<?= Html::input('text', 'Seo[title]', '', ['id' => 'seo-title', 'class' => 'form-control']) ?>
		</div>
		<div class="form-group">
			<?= Html::label($seo->getAttributeLabel('keywords'), 'seo-keywords', ['class' => 'control-label']) ?>
			<?= Html::input('text', 'Seo[keywords]', '', ['id' => 'seo-keywords', 'class' => 'form-control']) ?>
		</div>
		<div class="form-group">
			<?= Html::label($seo->getAttributeLabel('description'), 'seo-description', ['class' => 'control-label']) ?>
			<?= Html::textarea('Seo[description]', '', ['id' => 'seo-description', 'class' => 'form-control']) ?>
		</div>
		<div class="form-group">
			<?= Html::label($seo->getAttributeLabel('description'), 'seo-og_image_id', ['class' => 'control-label']) ?>
			<?= Html::fileInput('Seo[og_image_id]', null, ['id' => 'seo-og_image_id', 'class' => 'form-control']) ?>
		</div>
	<?php else : ?>
		<div class="form-group">
			<?= Html::label($seo->getAttributeLabel('title'), 'seo-title', ['class' => 'control-label']) ?>
			<?= Html::input('text', 'Seo[title]', $seo->title, ['id' => 'seo-title','class' => 'form-control']) ?>
		</div>
		<div class="form-group">
			<?= Html::label($seo->getAttributeLabel('keywords'), 'seo-keywords', ['class' => 'control-label']) ?>
			<?= Html::input('text', 'Seo[keywords]', $seo->keywords, ['id' => 'seo-keywords','class' => 'form-control']) ?>
		</div>
		<div class="form-group">
			<?= Html::label($seo->getAttributeLabel('description'), 'seo-description', ['class' => 'control-label']) ?>
			<?= Html::textarea('Seo[description]', $seo->description, ['id' => 'seo-description', 'class' => 'form-control']) ?>
		</div>
		<div class="form-group">
			<?= Html::label($seo->getAttributeLabel('description'), 'seo-og_image_id', ['class' => 'control-label']) ?>
			<?= Html::fileInput('Seo[og_image_id]', null, ['id' => 'seo-og_image_id', 'class' => 'form-control']) ?>
		</div>
	<?php endif ?>

</div>
