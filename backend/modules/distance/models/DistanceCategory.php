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
            [['label'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sport_id' => 'Вид спорта',
            'label' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistanceDistanceCategoryRefs()
    {
        return $this->hasMany(DistanceDistanceCategoryRef::className(), ['distance_category_id' => 'id']);
    }
}
