<?php

namespace sport\models;

use Yii;

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
}
