<?php
use yii\helpers\Html;
use metalguardian\fileProcessor\helpers\FPM;

if ($model->file->extension === 'pdf') {
    $src = '/img/download_file.png';
}else {
    $src = FPM::originalSrc($model->fpm_file_id);
}

echo Html::tag('div',
    Html::img($src, ['class' => 'img-fluid m-b-1']) .
    Html::tag('p', ['class' => 'small text-xs-center']),
    ['class' => 'col-xl-4']);