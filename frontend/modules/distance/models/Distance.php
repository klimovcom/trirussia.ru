<?php

namespace distance\models;

use Yii;

/**
 * This is the model class for table "distance".
 *
 * @property integer $id
 * @property string $label
 *
 * @property DistanceDistanceCategoryRef[] $distanceDistanceCategoryRefs
 * @property RaceDistanceRef[] $raceDistanceRefs
 */
class Distance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'distance';
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
    public function getDistanceDistanceCategoryRefs()
    {
        return $this->hasMany(DistanceDistanceCategoryRef::className(), ['distance_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceDistanceRefs()
    {
        return $this->hasMany(RaceDistanceRef::className(), ['distance_id' => 'id']);
    }
}
