<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model seo\models\Seo */
/* @var $form yii\widgets\ActiveForm */
?>

<button class="btn btn-primary seo-model-toggle">Настройки СЕО для объекта</button>
<div class="tab-pane" id="seo-tab">
    <div class="panel-body">
        <fieldset class="form-horizontal">
            <?php if ($model && $model->isNewRecord) : ?>
                <div class="form-group">
                    <?= Html::label($seo->getAttributeLabel('title') . ':', 'seo-title', ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::input('text', 'Seo[title]', '', ['id' => 'seo-title', 'class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::label(
                        $seo->getAttributeLabel('keywords') . ':',
                        'seo-keywords',
                        ['class' => 'col-sm-2 control-label']
                    ) ?>
                    <div class="col-sm-10">
                        <?= Html::input('text', 'Seo[keywords]', '', ['id' => 'seo-keywords', 'class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::label(
                        $seo->getAttributeLabel('description') . ':',
                        'seo-description',
                        ['class' => 'col-sm-2 control-label']
                    ) ?>
                    <div class="col-sm-10">
                        <?= Html::textarea('Seo[description]', '', ['id' => 'seo-description', 'class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::label(
                        $seo->getAttributeLabel('og_image_id') . ':',
                        'seo-og_image_id',
                        ['class' => 'col-sm-2 control-label']
                    ) ?>
                    <div class="col-sm-10">
                        <?= Html::fileInput('Seo[og_image_id]', '', ['id' => 'seo-og_image_id']) ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="form-group">
                    <?= Html::label($seo->getAttributeLabel('title') . ':', 'seo-title', ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::input('text', 'Seo[title]', $seo->title, ['id' => 'seo-title', 'class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::label(
                        $seo->getAttributeLabel('keywords') . ':',
                        'seo-keywords',
                        ['class' => 'col-sm-2 control-label']
                    ) ?>
                    <div class="col-sm-10">
                        <?= Html::input(
                            'text',
                            'Seo[keywords]',
                            $seo->keywords,
                            ['id' => 'seo-keywords', 'class' => 'form-control']
                        ) ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::label(
                        $seo->getAttributeLabel('description') . ':',
                        'seo-description',
                        ['class' => 'col-sm-2 control-label']
                    ) ?>
                    <div class="col-sm-10">
                        <?= Html::textarea(
                            'Seo[description]',
                            $seo->description,
                            ['id' => 'seo-description', 'class' => 'form-control']
                        ) ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::label(
                        $seo->getAttributeLabel('og_image_id') . ':',
                        'seo-og_image_id',
                        ['class' => 'col-sm-2 control-label']
                    ) ?>
                    <div class="col-sm-10">
                        <?php
                        $image = $seo->og_image_id ? Html::img(\metalguardian\fileProcessor\helpers\FPM::originalSrc($seo->og_image_id), ['class' => 'img-responsive']) : false;
                        if ($image) : ?>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label class="control-label">Превью</label>
                                    <div class="">
                                        <?= $image ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <?= Html::fileInput('Seo[og_image_id]', '', ['id' => 'seo-og_image_id']) ?>
                    </div>
                </div>
            <?php endif ?>
        </fieldset>
    </div>
</div>