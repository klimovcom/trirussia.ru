<?php
/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 6/13/16
 * Time: 10:17 AM
 * @var array $moreRaces
 * @var $this \yii\base\View
 */
use \willGo\models\WillGo;

$quest = Yii::$app->user->isGuest ? 'data-toggle="modal" data-target="#openUser"' : '';
?>
<?php foreach ($moreRaces as $race) {
    echo $this->render('//site/_card', [
        'race' => $race,
        'showImage' => false,
        'showAdditionalBlocks' => false,
        'showSizer' => false,
    ]);
}