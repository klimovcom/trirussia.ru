<?php

/* @var $this yii\web\View */
/* @var $model seo\models\Seo */
/* @var $form yii\widgets\ActiveForm */
if ($onlyButton) {
	echo $this->render('_button', ['class' => $class]);
} elseif ($onlyForm)  {
	echo $this->render('_form', ['seo' => $seo, 'model' => $model, 'isForm' => $isForm, 'class' => $class]);
} else {
	echo $this->render('_button', ['class' => $class]),
	$this->render('_form', ['seo' => $seo, 'model' => $model, 'isForm' => $isForm, 'class' => $class]);
}

\seo\assets\SeoAsset::register($this);
?>
