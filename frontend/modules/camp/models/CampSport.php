<?php

namespace camp\models;

use Yii;

/**
 * This is the model class for table "camp_sport".
 *
 * @property integer $camp_id
 * @property integer $sport_id
 *
 * @property Camp $camp
 * @property Sport $sport
 */
class CampSport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'camp_sport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['camp_id', 'sport_id'], 'required'],
            [['camp_id', 'sport_id'], 'integer'],
            [['camp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Camp::className(), 'targetAttribute' => ['camp_id' => 'id']],
            [['sport_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sport::className(), 'targetAttribute' => ['sport_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'camp_id' => 'Camp ID',
            'sport_id' => 'Sport ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCamp()
    {
        return $this->hasOne(Camp::className(), ['id' => 'camp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSport()
    {
        return $this->hasOne(Sport::className(), ['id' => 'sport_id']);
    }
}
