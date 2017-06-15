<?php

namespace user\models;

use common\models\UserInfo;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $fb_id
 * @property string $first_name
 * @property string $last_name
 * @property string $sex
 * @property string $locale
 * @property string $timezone
 * @property string $age
 * @property string $birthday
 * @property string $place
 * @property integer $send_training_message
 *
 * @property Post[] $posts
 */
class User extends \common\models\User
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['birthday'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'fb_id', 'first_name', 'last_name', 'sex', 'locale', 'timezone', 'age', 'place'], 'string', 'max' => 255],
            [['photo_url'], 'string', 'max' => 1024],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'fb_id' => 'Fb ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'sex' => 'Sex',
            'locale' => 'Locale',
            'timezone' => 'Timezone',
            'age' => 'Age',
            'birthday' => 'Birthday',
            'place' => 'Place',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['author_id' => 'id']);
    }

    public function getFullName(){
        return $this->last_name . ' ' . $this->first_name;
    }

    public function getUserInfo() {
        return $this->hasOne(UserInfo::className(), ['user_id' => 'id']);
    }
}
