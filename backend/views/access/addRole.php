<?php
namespace developeruz\db_rbac\views\access;

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('db_rbac', 'Новая роль');
$this->params['breadcrumbs'][] = ['label' => Yii::t('db_rbac', 'Управление ролями'), 'url' => ['role']];
$this->params['breadcrumbs'][] = Yii::t('db_rbac', 'Новая роль');
?>
<section class="content-header">
    <?php
    $breadcrumbs = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
    if ($breadcrumbs) {?>
        <?= \yii\widgets\Breadcrumbs::widget(
            [
                'links' => $breadcrumbs,
                'tag' => 'h1',
                'itemTemplate' => "{link}\n <span>•</span> ",
                'activeItemTemplate' => "<small>{link}</small>\n",
                'options' => ['class' => '',]
            ]
        ) ?>
    <?php } ?>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-9">
            <div class="box box-primary">
                <div class="box-body">
                    <?php
                    if (!empty($error)) {
                        ?>
                        <div class="error-summary">
                            <?php
                            echo implode('<br>', $error);
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php $form = ActiveForm::begin(); ?>

                    <div class="form-group">
                        <?= Html::label(Yii::t('db_rbac', 'Название роли')); ?>
                        <?= Html::textInput('name', null, ['class' => 'form-control']); ?>
                        <?= Yii::t('db_rbac', '* только латинские буквы, цифры и _ -'); ?>
                    </div>

                    <div class="form-group">
                        <?= Html::label(Yii::t('db_rbac', 'Текстовое описание')); ?>
                        <?= Html::textInput('description', null, ['class' => 'form-control']); ?>
                    </div>

                    <div class="form-group">
                        <?= Html::label(Yii::t('db_rbac', 'Разрешенные доступы')); ?>
                        <?= Html::checkboxList('permissions', null, $permissions, ['class' => 'checkbox-list']); ?>
                    </div>

                    <div class="box-footer">
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('db_rbac', 'Сохранить'), ['class' => 'btn btn-success']) ?>
                        </div>

                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>