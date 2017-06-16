<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$sportArray = array_merge(['all' => 'Все виды спорта'], ArrayHelper::map($sports, 'label', 'label'));
?>
<div class="search-container">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <p><strong>Где проходят</strong></p>
                <ul class="list-inline">
                    <?php
                    foreach ($authors as $item) {
                        echo Html::tag('li', Html::a($item['trainer_name'], ['/training/default/index', 'trainer' => $item['trainer_name']], ['class' => 'underline']) . ' ' . Html::tag('span', $item['training_count'], ['class' => 'small text-muted']), ['class' => 'list-inline-item']);
                    }
                    ?>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <p><strong>Кто проводит</strong></p>
                <ul class="list-inline">
                    <?php
                    foreach ($places as $item) {
                        echo Html::tag('li', Html::a($item['label'], ['/training/default/index', 'place' => $item['label']], ['class' => 'underline']) . ' ' . Html::tag('span', $item['place_count'], ['class' => 'small text-muted']), ['class' => 'list-inline-item']);
                    }
                    ?>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <div class="register m-a-0">
                    <p class="text-muted">Если вы устраиваете тренировки, то добавьте её бесплатно.</p>
                    <?php if(Yii::$app->user->isGuest) {
                        echo Html::a('Добавить тренировку', ['/training/default/create'], ['class' => 'btn btn-secondary btn-sm', 'data-toggle' => 'modal', 'data-target' => '#openUser']);
                    }else {
                        echo Html::a('Добавить тренировку', ['/training/default/create'], ['class' => 'btn btn-secondary btn-sm']);
                    }?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="pull-left">
        <h1 class="m-y-3">
            <?php
            if ($trainer) {
                echo 'Тренировки тренера ' . $trainer;
            }elseif ($place) {
                echo 'Тренировки в ' . $place;
            }else {
                echo 'Тренировки на велосипедах, по плаванию и бегу';
            }
            ?>
        </h1>
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
