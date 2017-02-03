<?php

namespace coach\models;

use Yii;

/**
 * This is the model class for table "coach_sport_ref".
 *
 * @property integer $id
 * @property integer $coach_id
 * @property integer $sport_id
 */
class CoachSportRef extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coach_sport_ref';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coach_id', 'sport_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coach_id' => 'Coach ID',
            'sport_id' => 'Sport ID',
        ];
    }
}
