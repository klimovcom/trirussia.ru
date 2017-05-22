<?php

namespace race\models;

use Yii;

/**
 * This is the model class for table "race_relay".
 *
 * @property integer $id
 * @property integer $race_id
 * @property integer $distance_id
 * @property integer $position
 * @property integer $distance
 * @property integer $sport
 */
class RaceRelay extends \yii\db\ActiveRecord
{

    const SPORT_RUN = 0;
    const SPORT_CYCLE = 1;
    const SPORT_SWIM = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'race_relay';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['race_id', 'distance_id', 'position', 'distance', 'sport'], 'required'],
            [['race_id', 'distance_id', 'position', 'distance', 'sport'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'race_id' => 'Race ID',
            'distance_id' => 'Distance ID',
            'position' => 'Position',
            'distance' => 'Distance',
        ];
    }

    public static function getSportArray() {
        return [
            self::SPORT_RUN => 'Бег',
            self::SPORT_CYCLE => 'Вело',
            self::SPORT_SWIM => 'Плавание',
        ];
    }
}
