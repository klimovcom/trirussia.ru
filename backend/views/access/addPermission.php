<?php
namespace developeruz\db_rbac\views\access;

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Links */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('db_rbac', 'Новое правило');
$this->params['breadcrumbs'][] = ['label' => Yii::t('db_rbac', 'Правила доступа'), 'url' => ['permission']];
$this->params['breadcrumbs'][] = Yii::t('db_rbac', 'Новое правило');
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
                        <?= Html::label(Yii::t('db_rbac', 'Текстовое описание')); ?>
                        <?= Html::textInput('description', null, ['class' => 'form-control']); ?>
                    </div>

                    <div class="form-group">
                        <?= Html::label(Yii::t('db_rbac', 'Разрешенный доступ')); ?>
                        <?= Html::textInput('name', null, ['class' => 'form-control']); ?>
                        <?=Yii::t('db_rbac', '<br>* Формат: <strong>module/controller/action</strong><br><strong>site/article</strong> - доступ к странице "site/article"<br><strong>site</strong> - доступ к любым action контроллера "site"');?>
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
