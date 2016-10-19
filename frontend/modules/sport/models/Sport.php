<?php

namespace sport\models;

use Yii;
use yii\helpers\VarDumper;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "sport".
 *
 * @property integer $id
 * @property string $label
 *
 * @property Race[] $races
 */
class Sport extends \yii\db\ActiveRecord
{
    public static $currentSportModel = false;
    public static $allSportModels = false;

    /**
     * @return array
     */
    public static function sportNames(){
        return [
            'велоспорт' => [
                'именительный' => 'велоспорт',
                'дательный' => 'велоспорту',
            ],
            'лыжи' => [
                'именительный' => 'лыжи',
                'дательный' => 'лыжам',
            ],
            'дуатлон' => [
                'именительный' => 'дуатлон',
                'дательный' => 'дуатлону',
            ],
            'плавание' => [
                'именительный' => 'плавание',
                'дательный' => 'плаванию',
            ],
            'бег' => [
                'именительный' => 'бег',
                'дательный' => 'бегу',
            ],
            'триатлон' => [
                'именительный' => 'триатлон',
                'дательный' => 'триатлону',
            ],
            'бокс' => [
                'именительный' => 'бокс',
                'дательный' => 'боксу',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaces()
    {
        return $this->hasMany(Race::className(), ['sport_id' => 'id']);
    }

    public static function getCurrentSportModel(){
        if (empty($_GET['sport'])) return null;
        if (self::$currentSportModel === false){
            self::$currentSportModel = null;
            if (!empty($_GET['sport'])){
                $model = self::find()->where(['url' => $_GET['sport']])->one();
                if (!$model) throw new NotFoundHttpException();
                self::$currentSportModel = $model;
            }
        }
        return self::$currentSportModel;
    }

    public static function getAllSportModels(){
        if (self::$allSportModels === false){
            self::$allSportModels = Sport::find()->all();
        }
        return self::$allSportModels;
    }

    /**
     * @param $case
     * @return string
     */
    public static function getCurrentSportLabel($case = 'именительный')
    {

        if (self::getCurrentSportModel()){
            $label = mb_strtolower(self::getCurrentSportModel()->label, 'utf-8');
            return isset(self::sportNames()[$label][$case]) ? self::sportNames()[$label][$case] : null;
        }
        return null;
    }
    
    public static function getSportUrls(){
        $result = [];
        /** @var Sport $sport */
        foreach (self::getAllSportModels() as $sport){
            $result[$sport->label] = $sport->url;
        }
        return $result;
    }

    public function getViewUrl()
    {
        return \yii\helpers\Url::to('/' . $this->url);
    }

    public function getLabelModified()
    {
        return self::sportNames()[mb_strtolower($this->label, 'utf-8')]['дательный'];
    }

    public function getCondition()
    {
        $condition = [];
        if (!empty($_GET['country'])){
            $condition[] = ' в стране ' . urldecode($_GET['country']);
        }
        if (!empty($_GET['organizer'])){
            $condition[] = ' организатора ' . urldecode($_GET['organizer']);
        }
        if (!empty($_GET['distance'])){
            $condition[] = 'на дистанции ' . urldecode($_GET['distance']);
        }
        if (!empty($_GET['date'])){
            $mon=substr($_GET['date'], 5, 2);

            $months = array(
                1 =>  'январе',
                2 =>  'феврале',
                3 =>  'марте',
                4 =>  'апреле',
                5 =>  'мае',
                6 =>  'июне',
                7 =>  'июле',
                8 =>  'августе',
                9 =>  'сентябре',
                10 => 'октябре',
                11 => 'ноябре',
                12 => 'декабре',
            );
            foreach($months as $key=>$value ){
                if($key==$mon){
                    $mon=$months[$key];
                }
            }


            $condition[] = ' в '. $mon . ' ' . Yii::$app->formatter->asDate($_GET['date'], 'yyyy') . ' г.';

        }
        return implode(' ', $condition);
    }
}
