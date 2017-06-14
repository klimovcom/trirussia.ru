<?php
use yii\helpers\Html;
use training_plan\models\TrainingPlan;
use yii\helpers\ArrayHelper;

$sportArray = array_merge(['all' => 'Все виды спорта'], ArrayHelper::map($sports, 'label', 'label'));

$levelArray = ['all' => 'Все уровни подготовки'];
foreach (TrainingPlan::getLevelArray() as $i) {
    $levelArray[$i] = $i;
}

$formatArray = ['all' => 'Любой формат'];
foreach (TrainingPlan::getFormatArray() as $i) {
    $formatArray[$i] = $i;
}
?>

<div class="container">
    <div class="pull-left">
        <h1 class="m-y-3">Тренировочные планы по триатлону, бегу, плаванию</h1>
    </div>
    <div class="clearfix"></div>
    <div class="card card-block">
        <form class="form-inline">
            <div class="form-group">
                <?= Html::dropDownList('sort', $sort, [
                    'popularity' => 'По популярности',
                    'price' => 'По цене',
                ], ['class' => 'c-select small']
                );?>
            </div>
            <div class="form-group">
                <?= Html::dropDownList('sport_name', $sport_name, $sportArray, ['class' => 'c-select small']);?>
            </div>
            <div class="form-group">
                <?= Html::dropDownList('level', $level, $levelArray, ['class' => 'c-select small']);?>
            </div>
            <div class="form-group">
                <?= Html::dropDownList('format', $format, $formatArray, ['class' => 'c-select small']);?>
            </div>

            <div class="pull-right">
                <button type="submit" class="btn btn-secondary btn-sm">Показать</button>
            </div>
        </form>
    </div>

    <?php
    if (count($models)) {
        echo Html::tag('div', $this->render('plans', [
            'models' => $models,
            'cardClass' => 'col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4',
        ]), ['class' => 'row']);
    }else {
        echo Html::tag('h4', 'К сожалению, ничего не найдено. Попробуйте изменить параметры поиска');
    }
    ?>

</div>