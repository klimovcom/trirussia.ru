<?php

namespace race\models;

use Yii;
use distance\models\Distance;
use user\models\User;

/**
 * This is the model class for table "race_relay_registration".
 *
 * @property integer $id
 * @property integer $race_id
 * @property integer $distance_id
 * @property integer $user_id
 * @property integer $group
 * @property integer $position
 * @property integer $is_first
 * @property integer $send_notifications
 * @property string $time
 *
 * @property Distance $distance
 * @property Race $race
 * @property User $user
 */
class RaceRelayRegistration extends \yii\db\ActiveRecord
{

    const LIMIT_REGISTRATION_FOR_RELAY = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'race_relay_registration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['race_id', 'distance_id', 'user_id', 'group', 'position', 'time'], 'required'],
            [['race_id', 'distance_id', 'user_id', 'group', 'position', 'is_first', 'send_notifications'], 'integer'],
            [['time'], 'string', 'max' => 255],
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
            'race_id' => 'Race ID',
            'distance_id' => 'Distance ID',
            'user_id' => 'User ID',
            'group' => 'Group',
            'position' => 'Position',
            'is_first' => 'Is First',
            'send_notifications' => 'Send Notifications',
            'time' => 'Time',
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
