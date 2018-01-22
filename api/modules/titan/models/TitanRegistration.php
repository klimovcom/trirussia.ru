<?php

namespace api\modules\titan\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "titan_registration".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $race_id
 * @property integer $city_id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $birth_date
 * @property integer $gender
 * @property string $primary_phone
 * @property string $primary_email
 * @property string $emergency_phone
 * @property string $status
 */
class TitanRegistration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'titan_registration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['race_id', 'city_id', 'first_name', 'last_name', 'birth_date', 'gender', 'primary_phone', 'primary_email', 'emergency_phone', 'status'], 'required'],
            [['race_id', 'city_id', 'gender'], 'integer'],
            [['birth_date'], 'safe'],
            [['first_name', 'last_name', 'middle_name', 'primary_phone', 'primary_email', 'emergency_phone', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'race_id' => 'Race ID',
            'city_id' => 'City ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'birth_date' => 'Birth Date',
            'gender' => 'Gender',
            'primary_phone' => 'Primary Phone',
            'primary_email' => 'Primary Email',
            'emergency_phone' => 'Emergency Phone',
            'status' => 'Status',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
            ],
        ];
    }
}
