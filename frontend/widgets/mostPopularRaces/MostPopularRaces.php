<?php
namespace frontend\widgets\mostPopularRaces;
use race\models\Race;


/**
 * Class MostPopularRaces
 * @package frontend\widgets\mostPopularRaces
 */
class MostPopularRaces extends \yii\base\Widget{

    public $models = [];

    public function run(){
        $this->models = Race::find()
            ->where(['>', 'start_date', date('Y-m-d', time()+6*60*60)])
            ->orderBy('popularity DESC')
            ->limit(4)
            ->all();
        return $this->render('default', ['races' => $this->models, ]);
    }
}