<?php
namespace frontend\widgets\allRaces;
use race\models\Race;


/**
 * Class AllRaces
 * @package frontend\widgets\allRaces
 */
class AllRaces extends \yii\base\Widget{

    /**
     * @var $model Race
     */
    public $model;
    public $models = [];

    public function run(){
        return $this->render('default', []);
    }

    public function getMonths($i){
        $months = [
            null,
            'Январь',
            'Февраль',
            'Март',
            'Апрель',
            'Май',
            'Июнь',
            'Июль',
            'Август',
            'Сентябрь',
            'Октябрь',
            'Ноябрь',
            'Декабрь',
        ];
        return $months[$i];
    }
}