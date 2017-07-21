<?php
use yii\helpers\Html;
$this->registerJs("$(function() {
        $('.card').matchHeight();
    });");

if ($organizer) {
    $header = 'Кэмпы ' . $organizer->label .' по триатлону, бегу и велоспорту';
    $data = 'data-lock="0" data-url="/camp/default/get-more-camps" data-target=".camps-block"  data-render-type="search" data-sort="" data-limit="30" data-organizer="' . $organizer->id . '"';
}elseif ($country) {
    $header = 'Кэмпы в ' . $country . ' по триатлону, велоспорту и бегу';
    $data = 'data-lock="0" data-url="/camp/default/get-more-camps" data-target=".camps-block"  data-render-type="search" data-sort="" data-limit="30" data-country="' . $country . '"';
}else {
    $header = 'Кэмпы по триатлону, велоспорту и бегу';
    $data = 'data-lock="0" data-url="/camp/default/get-more-camps" data-target=".camps-block"  data-render-type="search" data-sort="" data-limit="30"';
}
?>
<div class="search-container">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <p><strong>Популярные направления</strong></p>
                <ul class="list-inline">
                    <?php
                    foreach ($countries as $item) {
                        echo Html::tag('li', Html::a($item['country'], ['/camp/default/index', 'country' => $item['country']], ['class' => 'underline']) . ' ' . Html::tag('span', $item['country_count'], ['class' => 'small text-muted']), ['class' => 'list-inline-item']);
                    }
                    ?>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <p><strong>Кто проводит</strong></p>
                <ul class="list-inline">
                    <?php
                    foreach ($organizers as $item) {
                        echo Html::tag('li', Html::a($item['label'], ['/camp/default/index', 'organizer' => $item['label']], ['class' => 'underline']) . ' ' . Html::tag('span', $item['organizers_count'], ['class' => 'small text-muted']), ['class' => 'list-inline-item']);
                    }
                    ?>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <div class="register m-a-0">
                    <p class="text-muted">Если вы устраиваете кэмп или сборы, добавьте их в календарь. Просто напишите на <a href="mailto:artem@klimov.com">artem@klimov.com</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="pull-left">
        <h1 class="m-y-3"><?= $header;?></h1>
    </div>
    <div class="clearfix"></div>

    <div class="row camps-block">
        <?php
        foreach ($models as $model) {
            echo $this->render('card', [
                'model' => $model,
            ]);
        }
        ?>
    </div>
    <?php if ($showMore):?>
        <div class="block block-more-races block-more-races-sport ">
            <button type="submit" class="btn btn-primary more-races" <?= $data;?>>
                Загрузить еще кэмпы
            </button>
        </div>
    <?php endif;?>
</div>
