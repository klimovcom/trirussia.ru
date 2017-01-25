<?php
namespace frontend\widgets\pastRaces;
use race\models\Race;


/**
 * Class PastRaces
 * @package frontend\widgets\pastRaces
 */
class PastRaces extends \yii\base\Widget{

    public $models = [];

    public function run(){
        $this->models = Race::find()
            ->where(['<', 'start_date', date('Y-m-d', time()-4*60*60)])
            ->published()
            ->orderBy('start_date DESC')
            ->limit(4)
            ->all();
        return $this->render('default', ['pastRaces' => $this->models, ]);
    }
}