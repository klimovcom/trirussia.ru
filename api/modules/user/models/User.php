<?php

namespace api\modules\user\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use developeruz\db_rbac\interfaces\UserRbacInterface;
use yii\base\NotSupportedException;

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
 */
class User extends \common\models\User
{
    public $role;
    public $password;

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
            [['username', 'email'], 'required'],
            [['status'], 'integer'],
            [
                [
                    'username',
                    'password_hash',
                    'password_reset_token',
                    'email',
                    'fb_id',
                    'first_name',
                    'last_name',
                    'sex',
                    'locale',
                    'timezone',
                    'age',
                    'birthday',
                    'place',
                    'password',
                ],
                'string',
                'max' => 255
            ],
            [['auth_key'], 'string', 'max' => 32],
            [['photo_url'], 'string', 'max' => 1024],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['role', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'E-mail',
            'status' => 'Статус',
            'created_at' => 'Дата регистрации',
            'updated_at' => 'Обновлен',
            'fb_id' => 'Facebook ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'sex' => 'Пол',
            'locale' => 'Локаль',
            'timezone' => 'Временная зона',
            'age' => 'Возраст',
            'birthday' => 'Дата рождения',
            'place' => 'Местонахождение',
            'photo_url' => 'Фото',
            'role' => 'Роль',
            'password' => 'Пароль (задание нового)',

        ];
    }

    public function beforeSave($insert) {

        if ($this->isNewRecord) {
            $this->generateAuthKey();
            $this->status = User::STATUS_ACTIVE;
        }

        if ($this->password) {
            $this->setPassword($this->password);
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        $this->updateRoles();

        return true;
    }

    public function getUserName() {
        return $this->username;
    }

    public function getId() {
        return $this->id;
    }

    public function updateRoles() {
        $oldRoleName = ArrayHelper::getValue(array_keys(Yii::$app->authManager->getRolesByUser($this->id)), 0);
        $role = Yii::$app->authManager->getRole($this->role);
        if ($role && $oldRoleName !== $role->name) {
            Yii::$app->authManager->revokeAll($this->id);
            Yii::$app->authManager->assign($role, $this->id);
        }

        return true;
    }

    public static function getAuthorData()
    {
        $users = User::find()->all();
        $data = [];
        /** @var User $user */
        foreach ($users as $user) {
            $data[$user->id] = $user->username . "::" . $user->email . "::" . $user->id;
        }
        return $data;
    }
}
