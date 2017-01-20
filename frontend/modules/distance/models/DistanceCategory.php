<?php

namespace distance\models;

use Yii;

/**
 * This is the model class for table "distance_category".
 *
 * @property integer $id
 * @property string $label
 * @property integer $sport_id
 *
 * @property DistanceDistanceCategoryRef[] $distanceDistanceCategoryRefs
 * @property RaceDistanceCategoryRef[] $raceDistanceCategoryRefs
 */
class DistanceCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'distance_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label'], 'required'],
            [['sport_id'], 'integer'],
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
            'sport_id' => 'Sport ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistanceDistanceCategoryRefs()
    {
        return $this->hasMany(DistanceDistanceCategoryRef::className(), ['distance_category_id' => 'id']);
    }

    public function getDistances() {
        return $this->hasMany(Distance::className(), ['id' => 'distance_id'])->viaTable('distance_distance_category_ref', ['distance_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceDistanceCategoryRefs()
    {
        return $this->hasMany(RaceDistanceCategoryRef::className(), ['distance_category_id' => 'id']);
    }
}
