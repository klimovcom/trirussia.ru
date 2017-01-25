<?php
namespace frontend\widgets\mostPopularSportRaces;
use race\models\Race;
use sport\models\Sport;


/**
 * Class MostPopularSportRaces
 * @package frontend\widgets\mostPopularSportRaces
 */
class MostPopularSportRaces extends \yii\base\Widget{

    public $models = [];

    public function run(){
        if (isset($_GET['sport'])){
            $sport = $_GET['sport'];
            $sportModel = Sport::find()->where(['url' => $sport])->one();
            $this->models = Race::find()
                ->where(['>', 'start_date', date('Y-m-d', time()+6*60*60)])
                ->andWhere(['sport_id' => $sportModel->id, ])
                ->published()
                ->orderBy('popularity DESC')
                ->limit(3)
                ->all();
            return $this->render('default', ['races' => $this->models, 'sport' => $sportModel   , ]);
        }
    }
}