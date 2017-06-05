<?php

namespace race\models;

use Yii;
use user\models\User;
use distance\models\Distance;

/**
 * This is the model class for table "race_slot_sell".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $race_id
 * @property integer $distance_id
 * @property integer $type
 * @property string $price
 *
 * @property Distance $distance
 * @property Race $race
 * @property User $user
 */
class RaceSlotSell extends \yii\db\ActiveRecord
{

    const TYPE_SELL = 1;
    const TYPE_BUY = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'race_slot_sell';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'race_id', 'distance_id', 'type'], 'integer'],
            [['type', 'price'], 'required'],
            [['price'], 'string', 'max' => 255],
            [['distance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Distance::className(), 'targetAttribute' => ['distance_id' => 'id']],
            [['race_id'], 'exist', 'skipOnError' => true, 'targetClass' => Race::className(), 'targetAttribute' => ['race_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'race_id' => 'Race ID',
            'distance_id' => 'Distance ID',
            'type' => 'Type',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistance()
    {
        return $this->hasOne(Distance::className(), ['id' => 'distance_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
