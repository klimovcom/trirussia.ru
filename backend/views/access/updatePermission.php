<?php
namespace developeruz\db_rbac\views\access;

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Links */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('db_rbac', 'Редактирование правила: ') . ' ' . $permit->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('db_rbac', 'Правила доступа'), 'url' => ['permission']];
$this->params['breadcrumbs'][] = Yii::t('db_rbac', 'Редактирование правила');
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
                        <?= Html::textInput('description', $permit->description, ['class' => 'form-control']); ?>
                    </div>

                    <div class="form-group">
                        <?= Html::label(Yii::t('db_rbac', 'Разрешенный доступ')); ?>
                        <?= Html::textInput('name', $permit->name, ['class' => 'form-control']); ?>
                    </div>

                    <div class="box-footer">
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('db_rbac', 'Обновить'), ['class' => 'btn btn-primary']) ?>
                        </div>

                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>