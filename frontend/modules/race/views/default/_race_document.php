<?php
use yii\helpers\Html;
use metalguardian\fileProcessor\helpers\FPM;
use race\models\RaceFpmFile;

if ($model->file->extension === 'pdf') {
    $src = '/img/download_file.png';
    $img_class = 'img-fluid not-fancy';
}else {
    $src = FPM::originalSrc($model->fpm_file_id);
    $img_class = 'img-fluid pointer';
}

if ($model->type === RaceFpmFile::TYPE_REGULATION) {
    $name = 'Положение о соревновании №' . $counter;
}else {
    $name = 'Схема проезда №' . $counter;
}

echo Html::tag('div',
    Html::tag('div', Html::tag('div', Html::img($src, ['class' => $img_class]), ['class' => 'embed-responsive-item']), ['class' => 'embed-responsive embed-responsive-16by9  m-b-1']) .
    Html::tag('p', Html::a($name, FPM::originalSrc($model->fpm_file_id), ['class' => 'underline', 'target' => '_blank']),['class' => 'small text-xs-center']),
    ['class' => 'col-xl-4']);