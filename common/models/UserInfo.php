<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user_info".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $gender
 * @property string $birthdate
 * @property string $city
 * @property string $email
 * @property string $phone
 * @property string $emergency_first_name
 * @property string $emergency_last_name
 * @property string $emergency_phone
 * @property string $emergency_relation
 * @property string $team
 * @property string $shirt_size
 *
 * @property User $user
 */
class UserInfo extends \yii\db\ActiveRecord
{

    const DADATA_NAME_URL = 'https://dadata.ru/api/v2/clean/name';
    const DADATA_GEOIP_URL = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/detectAddressByIp?ip=';

    const GENDER_NOT_DEFINED = 0;
    const GENDER_FEMALE = 1;
    const GENDER_MALE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name', 'gender', 'birthdate', 'city', 'email', 'phone', 'emergency_first_name', 'emergency_last_name', 'emergency_phone', 'emergency_relation', 'shirt_size'], 'required'],
            [['user_id', 'gender'], 'integer'],
            [['birthdate'], 'safe'],
            [['first_name', 'last_name', 'city', 'email', 'phone', 'emergency_first_name', 'emergency_last_name', 'emergency_phone', 'emergency_relation', 'team', 'shirt_size'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['email'], 'email'],
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
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'gender' => 'Пол',
            'birthdate' => 'День рождения',
            'city' => 'Город',
            'email' => 'Email',
            'phone' => 'Телефон',
            'emergency_first_name' => 'Имя',
            'emergency_last_name' => 'Фамилия',
            'emergency_phone' => 'Телефон',
            'emergency_relation' => 'Степень родства',
            'team' => 'Команда или клуб',
            'shirt_size' => 'Размер футболки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function setDefaultInfo() {
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;

        if ($this->user->gender) {
            if ($this->user->gender === 'female') {
                $this->gender = self::GENDER_FEMALE;
            }else {
                $this->gender = self::GENDER_MALE;
            }
        }else {
            $this->gender = $this->getGenderFromDadata();
        }

        $this->birthdate = $this->user->birthday;
        $this->city = $this->getCityFromDadata();
        $this->email = $this->user->email;


    }

    public function getCityFromDadata() {
        $data = $this->sendDadataRequest(self::DADATA_GEOIP_URL . Yii::$app->request->userIP, false);

        if ($data === false) {
            return null;
        }else {
            return ArrayHelper::getValue(json_encode($data), 'location.data.region');
        }
    }

    public function getGenderFromDadata() {
        $data = $this->sendDadataRequest(self::DADATA_NAME_URL, true, json_encode([$this->first_name . ' ' . $this->last_name]));
        if ($data === false) {
            return self::GENDER_NOT_DEFINED;
        }
        $gender = ArrayHelper::getValue(json_decode($data), '0.gender');
        switch ($gender) {
            case 'М' :
                return self::GENDER_MALE;
            case 'Ж' :
                return self::GENDER_FEMALE;
            default :
                return self::GENDER_NOT_DEFINED;
        }
    }

    public function sendDadataRequest($url, $is_post, $data = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);

        if ($is_post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Token ' . Yii::$app->params['dadataApiKey'],
            'X-Secret: ' . Yii::$app->params['dadataSecretKey'],
        ));
        $curlResult = curl_exec($ch);
        curl_close ($ch);
        return $curlResult;
    }

    public static function getGenderArray() {
        return [
            self::GENDER_FEMALE => 'Женский',
            self::GENDER_MALE => 'Мужской',
        ];
    }

    public static function getShirtSizeArray() {
        return [
            'XS' => 'XS',
            'S' => 'S',
            'M' => 'M',
            'L' => 'L',
            'XL' => 'XL',
        ];
    }
}
