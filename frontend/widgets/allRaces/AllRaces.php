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
    public $raceView;
    public $sport;
    public $models = [];

    public function run(){
        if (!empty($this->sport)){
            $_GET['sport'] = $this->sport;
        }

        $params = [
            'racesByMonths' => \race\models\Race::getAllRacesByMonthsAndSport(date('Y-m'), date('Y-m', strtotime("+12 month"))),
            'racesBySports' => \race\models\Race::getAllRacesBySport(date('Y-m')),
            'racesByCountries' => $this->raceView ? null : \race\models\Race::getAllRacesByCountriesAndSport(date('Y-m')),
            'racesByOrganizers' => $this->raceView ? null : \race\models\Race::getAllRacesByOrganizersAndSport(date('Y-m')),
            'racesByDistancesRun' => \race\models\Race::getCalculatedAllRacesBySportDistances('Бег'),
            'racesByDistancesTriathlon' => \race\models\Race::getCalculatedAllRacesBySportDistances('Триатлон'),
            'sportModel' => \sport\models\Sport::getCurrentSportModel(),
        ];

        if (!empty($this->sport)){
            unset($_GET['sport']);
        }

        if ($this->raceView)
            return $this->render('race-sidebar', $params);

        return $this->render('default', $params);
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