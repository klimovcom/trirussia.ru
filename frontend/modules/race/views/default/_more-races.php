<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 6/13/16
 * Time: 10:17 AM
 * @var array $moreRaces
 * @var $this \yii\base\View
 */

?>
<div class="row">
    <div class="grid">
        <?php foreach ($moreRaces as $race){
            print $this->render('//site/_card', [
                'race' => $race,
                'showImage' => true,
                'showAdditionalBlocks' => true,
                'showSizer' => true,
            ]);
        }?>
    </div>
</div>