<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
/**
 * @var $races \race\models\Race[]
 */
$this->registerJs("$(function() {
        $('.card').matchHeight();
    });");
?>
<div class="container">
    <div class="news-block-container">
        <h4 class="PTSerif"><i>Гонки найденные по запросу "<?= $q;?>":</i></h4>
    </div>

    <div class="row m-t-2">
        <?php foreach ($races as $race) {
            echo $this->render('//site/_card', [
                'race' => $race,
                'showImage' => false,
                'showAdditionalBlocks' => false,
                'showSizer' => false,
            ]);
        }
        ?>
    </div>

</div>

