<?php

namespace distance\models;

use Yii;

/**
 * This is the model class for table "distance".
 *
 * @property integer $id
 * @property integer $sport_id
 * @property string $label
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
            'sport_id' => 'Спорт',
            'label' => 'Название',
        ];
    }
}
