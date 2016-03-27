<?php

namespace coach\models;

use metalguardian\fileProcessor\behaviors\UploadBehavior;
use metalguardian\fileProcessor\helpers\FPM;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "coach".
 *
 * @property integer $id
 * @property string $created
 * @property string $label
 * @property integer $image_id
 * @property string $country
 * @property string $site
 * @property string $phone
 * @property string $email
 * @property string $fb_link
 * @property string $vk_link
 * @property string $ig_link
 */
class Coach extends \yii\db\ActiveRecord
{
    public function __construct(array $config = [])
    {
        $this->created = date("Y-m-d H:i", time());
        return parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coach';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'label', 'image_id', 'country'], 'required'],
            [['created'], 'safe'],
            [[/*'image_id'*/], 'integer'],
            [['label', 'country', 'site', 'phone', 'email', 'fb_link', 'vk_link', 'ig_link'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Создан',
            'label' => 'Имя',
            'image_id' => 'Изображение',
            'country' => 'Страна',
            'site' => 'Сайт',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'fb_link' => 'Ссылка facebook',
            'vk_link' => 'Ссылка vkontakte',
            'ig_link' => 'Ссылка instagram',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'image_id' => [
                    'class' => UploadBehavior::className(),
                    'attribute' => 'image_id',
                    'image' => true,
                    'required' => true,
                ],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        parent::beforeDelete();

        FPM::deleteFile($this->image_id);

        return true;
    }
}
