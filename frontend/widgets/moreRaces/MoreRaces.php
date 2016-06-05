<?php
namespace frontend\widgets\moreRaces;
use race\models\Race;


/**
 * Class MoreRaces
 * @package frontend\widgets\moreRaces
 */
class MoreRaces extends \yii\base\Widget{

    /**
     * @var $model Race
     */
    public $model;
    public $models = [];

    public function run(){
        if (!$this->model){
            $this->model = Race::find()->one();
        }
        $this->models = Race::find()
            ->where(['>', 'start_date', date('Y-m-d', time()+4*60*60)])
            ->andWhere(['sport_id' => $this->model->sport_id])
            ->orderBy('start_date')
            ->limit(6)
            ->all();
        return $this->render('default', ['races' => $this->models, ]);
    }
}