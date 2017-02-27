<?php

namespace common\models;

use Yii;
use race\models\Race;

/**
 * This is the model class for table "tristats_races".
 *
 * @property integer $id
 * @property string $name
 * @property integer $year
 * @property integer $race_id
 * @property string $race_url
 * @property string $date
 * @property integer $racer_count
 * @property string $min_swim
 * @property string $min_bike
 * @property string $min_run
 * @property string $min_finish
 */
class TristatsRaces extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tristats_races';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'year', 'race_id', 'race_url', 'place'], 'required'],
            [['year', 'race_id', 'racer_count'], 'integer'],
            [['date'], 'safe'],
            [['name', 'min_swim', 'min_bike', 'min_run', 'min_finish', 'place'], 'string', 'max' => 255],
            [['race_url'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'year' => 'Year',
            'race_id' => 'Race ID',
            'race_url' => 'Race Url',
            'date' => 'Date',
            'racer_count' => 'Racer Count',
            'min_swim' => 'Min Swim',
            'min_bike' => 'Min Bike',
            'min_run' => 'Min Run',
            'min_finish' => 'Min Finish',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaces()
    {
        return $this->hasMany(Race::className(), ['tristats_race_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTristatsWinners()
    {
        return $this->hasMany(TristatsWinners::className(), ['tristats_race_id' => 'id']);
    }
}
