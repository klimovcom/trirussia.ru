<?php

namespace distance\models;

use Yii;

/**
 * This is the model class for table "distance_distance_category_ref".
 *
 * @property integer $id
 * @property integer $distance_id
 * @property integer $distance_category_id
 *
 * @property DistanceCategory $distanceCategory
 * @property Distance $distance
 */
class DistanceDistanceCategoryRef extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'distance_distance_category_ref';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['distance_id', 'distance_category_id'], 'required'],
            [['distance_id', 'distance_category_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'distance_id' => 'Distance ID',
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
    public function getDistance()
    {
        return $this->hasOne(Distance::className(), ['id' => 'distance_id']);
    }
}
