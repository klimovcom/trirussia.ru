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
            ->andWhere(['sport_id' => $model->sport, ])
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

        //проходим по месяцам оставшимся до конца года
        for ($i = $monthNumber; $i<=12; $i++){
            $day = '01';
            $month = $i < 10 ? '0'.$i : $i;
            $year = date('Y', time());
            $date = implode('-', [$year, $month, $day, ]);
            $dateIntervals[$date] = $monthes[$i] . ' ' . $year;
        }

        //если до конца года меньше 6 месяцев то показываем весь следующий год, иначе только
        // первые 6 месяцев
        $nextYearMonthesCount = count($dateIntervals) < 6 ? 12 : 6;
        for($i = 1; $i <= $nextYearMonthesCount; $i++){
            $day = '01';
            $month = $i < 10 ? '0'.$i : $i;
            $year = date('Y', time()) + 1;
            $date = implode('-', [$year, $month, $day, ]);
            $dateIntervals[$date] = $monthes[$i] . ' ' . $year;
        }

        return $dateIntervals;
    }
}