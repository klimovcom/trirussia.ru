<?php
namespace frontend\widgets\otherRaces;
use race\models\Race;


/**
 * Class OtherRaces
 * @package frontend\widgets\otherRaces
 */
class OtherRaces extends \yii\base\Widget{

    public function run()
    {
        return $this->render('default', [/*'races' => $this->models, */]);
    }
}