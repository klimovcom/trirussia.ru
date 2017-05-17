<?php
use yii\helpers\Html;
$this->registerJs("$(function() {
        $('.card').matchHeight();
    });");
?>

<div class="container">
    <div class="pull-left">
        <h1 class="m-y-3">Кэмпы по триатлону, велоспорту и бегу</h1>
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
            <button type="submit" data-lock="0" data-url="/camp/default/get-more-camps" data-target=".camps-block"  data-render-type="search" data-sort="" data-limit="12" class="btn btn-primary more-races" >
                Загрузить еще кэмпы
            </button>
        </div>
    <?php endif;?>
</div>
