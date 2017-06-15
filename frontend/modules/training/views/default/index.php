<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$sportArray = array_merge(['all' => 'Все виды спорта'], ArrayHelper::map($sports, 'label', 'label'));
?>

<div class="container">
    <div class="pull-left">
        <h1 class="m-y-3">Тренировки на велосипедах, по плаванию и бегу</h1>
    </div>
    <div class="clearfix"></div>
    <div class="card card-block">
        <div class="pull-left">
            <form class="form-inline">
                <div class="form-group">
                    <?= Html::dropDownList('sport_name', $sport_name, $sportArray, ['class' => 'c-select small']);?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary btn-sm">Показать</button>
                </div>
            </form>
        </div>
        <div class="pull-right">
            <?php if(Yii::$app->user->isGuest) {
                echo Html::a('Узнавать о тренировках', 'javascript:;', ['class' => 'btn btn-primary-outline btn-sm', 'data-toggle' => 'modal', 'data-target' => '#openUser']);
            }else {
                if (Yii::$app->user->identity->send_training_message) {
                    echo Html::a('Убрать оповещения о тренировках', 'javascript:;', ['class' => 'btn btn-primary-outline btn-sm btn-training-send-message']);
                }else {
                    echo Html::a('Узнавать о тренировках', 'javascript:;', ['class' => 'btn btn-primary-outline btn-sm btn-training-send-message']);
                }
            };?>
            <span class="text-muted small m-l-1">За 3 дня до начала</span>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php
    if (count($models)) {
        echo Html::beginTag('div', ['class' => 'row']);
        foreach ($models as $model) {
            echo $this->render('card', [
                'model' => $model,
            ]);
        }
        echo Html::endTag('div');
    }else {
        echo Html::tag('h4', 'К сожалению, ничего не найдено. Попробуйте изменить параметры поиска');
    }
    ?>
</div>
