<?php

namespace race\models;

use distance\models\Distance;
use \Yii;

/**
 * This is the model class for table "race_distance_ref".
 *
 * @property integer $id
 * @property integer $race_id
 * @property integer $distance_id
 *
 * @property Distance $distance
 * @property Race $race
 */
class RaceDistanceRef extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'race_distance_ref';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['race_id', 'distance_id'], 'integer'],
            [['distance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Distance::className(), 'targetAttribute' => ['distance_id' => 'id']],
            [['race_id'], 'exist', 'skipOnError' => true, 'targetClass' => Race::className(), 'targetAttribute' => ['race_id' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistance()
    {
        return $this->hasOne(Distance::className(), ['id' => 'distance_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }
}
