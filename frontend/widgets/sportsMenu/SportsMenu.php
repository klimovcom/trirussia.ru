<?php
namespace frontend\widgets\sportsMenu;


use sport\models\Sport;

/**
 * Class SportsMenu
 * @package frontend\widgets\sportsMenu
 */
class SportsMenu extends \yii\base\Widget{

    public function run(){
        $sports = Sport::find()->where(['is_on_main' => 1])->all();
        return $this->render('default', ['sports' => $sports, ]);
    }
}