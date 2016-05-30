<?php
namespace frontend\widgets\pastRaces;


/**
 * Class PastRaces
 * @package frontend\widgets\pastRaces
 */
class PastRaces extends \yii\base\Widget{

    public $models = [];

    public function run(){
        return $this->render('default', ['pastRaces' => $this->models, ]);
    }
}