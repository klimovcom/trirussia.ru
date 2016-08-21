<?php
namespace frontend\widgets\searchRacesPanel;
use frontend\models\SearchRaceForm;
use organizer\models\Organizer;
use race\models\Race;
use sport\models\Sport;
use yii\db\sqlite\QueryBuilder;
use yii\web\NotFoundHttpException;


/**
 * Class SearchRacesPanel
 * @package frontend\widgets\searchRacesPanel
 */
class SearchRacesPanel extends \yii\base\Widget{
    
    function run(){
        $model = new SearchRaceForm();
        
        //если спорт был выбран в меню
        if (!empty($_GET['sport'])){
            $sportModel = Sport::find()->where(['url' => $_GET['sport']])->one();
            if (!$sportModel) throw new NotFoundHttpException();
            $model->sport = $sportModel->id;
        }

        if (!empty($_GET['organizer'])){
            $model->organizer = $_GET['organizer'];
        }

        if (!empty($_GET['distance'])){
            $model->distance = $_GET['distance'];
        }

        if (!empty($_GET['country'])){
            $model->country = $_GET['country'];
        }

        if (!empty($_POST['SearchRaceForm']))
            $model->setAttributes($_POST['SearchRaceForm'], false);

        $dateCondition = ['>=', 'start_date', date('Y-m-d', time())];
        if (!empty($_GET['date'])){
            $model->date = isset($this->getDateIntervals()[$_GET['date']]) ? $_GET['date'] : null;
            $dateCondition = ['between', 'start_date', $_GET['date'], substr($_GET['date'], 0, 8) . '31'];
        }

        $countriesData = (new \yii\db\Query())
            ->select(['country',])
            ->from(Race::tableName())
            ->where($dateCondition)
            ->groupBy('country')
            ->createCommand()
            ->queryAll();
        $countries = [];

        $organizersData = (new \yii\db\Query())
            ->select('organizer_id as id')
            ->from(Race::tableName())
            ->where($dateCondition)
            ->andWhere( $model->sport > 0 ? ['sport_id' => $model->sport, ] : [])
            ->groupBy('organizer_id')
            ->createCommand()
            ->queryAll();
        $idArray = [];
        foreach ($organizersData as $data){
            $idArray[] = $data['id'];

        }

        $organizers = Organizer::find()->where(['in', 'id', $idArray])->all();

        foreach ($countriesData as $country){
            $countries[$country['country']] = $country['country'];
        }

        return $this->render('default', [ 'model' => $model, 'countries' => $countries, 'organizers' => $organizers, ]);
    }

    static function getDateIntervals(){
        $monthNumber = (int)date('m', time());
        $dateIntervals = [];
        $monthes = [
            null, 'Янв', 'Фев', 'Март', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг','Сен', 'Окт', 'Ноя', 'Дек'
        ];

        for ($i = $monthNumber; $i<=$monthNumber+10; $i++){
            $day = '01';
            $year = date('Y', time());
            if ($i < 10 ){
                $month = '0'.$i;
            } else if ($i <= 12){
                $month = $i;
            } else {
                $month = $i - 12;
                $year++;
            }

            $date = implode('-', [$year, $month, $day, ]);

           /* $racesCount = (new \yii\db\Query())
                ->select('COUNT(id)')
                ->from(Race::tableName())
                ->where(['between', 'start_date', $date, substr($date, 0, 8) . '31'])
                ->andWhere(['sport_id' => Sport::getCurrentSportModel()->id, ])
                ->createCommand()
                ->queryOne()['COUNT(id)'];*/


            $dateIntervals[$date] = $monthes[(int)$month] . ' ' . $year /*. ' ('.$racesCount.')'*/;
        }
        return $dateIntervals;
    }
}