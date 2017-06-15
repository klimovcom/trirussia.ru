<?php

namespace training\models;

use Yii;

/**
 * This is the model class for table "training_place".
 *
 * @property integer $id
 * @property string $label
 *
 * @property Training[] $trainings
 */
class TrainingPlace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'training_place';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label'], 'required'],
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
            'label' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainings()
    {
        return $this->hasMany(Training::className(), ['place_id' => 'id']);
    }
}
