<?php
namespace frontend\widgets\votePastRace;
use race\models\Race;


/**
 * Class PastRaces
 * @package frontend\widgets\pastRaces
 */
class VotePastRace extends \yii\base\Widget{

    public $race;
    public $minPopularity = 300;

    public function run(){
        $this->race = Race::find()
            ->where(['>=', 'start_date', date('Y-m-d', strtotime('-7day'))])
            ->andWhere(['<', 'start_date', date('Y-m-d', time())])
            ->andWhere(['>', 'popularity', $this->minPopularity])
            ->published()
            ->orderBy('popularity DESC')
            ->one();
        if ($this->race) {
            return $this->render('default', [
                'race' => $this->race,
            ]);
        }else {
            return false;
        }

    }
}