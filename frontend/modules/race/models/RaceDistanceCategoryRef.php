<?php

namespace race\models;

use Yii;

/**
 * This is the model class for table "race_distance_category_ref".
 *
 * @property integer $id
 * @property integer $race_id
 * @property integer $distance_category_id
 *
 * @property DistanceCategory $distanceCategory
 * @property Race $race
 */
class RaceDistanceCategoryRef extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'race_distance_category_ref';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['race_id', 'distance_category_id'], 'integer'],
            [['distance_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => DistanceCategory::className(), 'targetAttribute' => ['distance_category_id' => 'id']],
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
            'distance_category_id' => 'Distance Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistanceCategory()
    {
        return $this->hasOne(DistanceCategory::className(), ['id' => 'distance_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }
}
