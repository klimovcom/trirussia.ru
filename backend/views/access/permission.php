<?php
namespace developeruz\db_rbac\views\access;

use Yii;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('db_rbac', 'Правила доступа');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header post-index">
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
    <p>
        <?= Html::a(Yii::t('db_rbac', 'Добавить новое правило'), ['add-permission'], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <?php
                    $dataProvider = new ArrayDataProvider([
                        'allModels' => Yii::$app->authManager->getPermissions(),
                        'sort' => [
                            'attributes' => ['name', 'description'],
                        ],
                        'pagination' => [
                            'pageSize' => 10,
                        ],
                    ]);
                    ?>

                    <?=GridView::widget([
                        'dataProvider' => $dataProvider,
                        'tableOptions' => ['class' => 'table table-striped table-bordered dataTable no-footer table',],
                        'layout'=>"{items}\n{summary}\n{pager}",
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'class'     => DataColumn::className(),
                                'attribute' => 'name',
                                'label'     => Yii::t('db_rbac', 'Правило')
                            ],
                            [
                                'class'     => DataColumn::className(),
                                'attribute' => 'description',
                                'label'     => Yii::t('db_rbac', 'Описание')
                            ],
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {delete}',
                                'buttons' =>
                                    [
                                        'update' => function ($url, $model) {
                                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::toRoute(['update-permission', 'name' => $model->name]), [
                                                'title' => Yii::t('yii', 'Update'),
                                                'data-pjax' => '0',
                                            ]); },
                                        'delete' => function ($url, $model) {
                                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::toRoute(['delete-permission','name' => $model->name]), [
                                                'title' => Yii::t('yii', 'Delete'),
                                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                                'data-method' => 'post',
                                                'data-pjax' => '0',
                                            ]);
                                        }
                                    ]
                            ],
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>