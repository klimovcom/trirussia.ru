<?php

namespace coach\models;

use metalguardian\fileProcessor\behaviors\UploadBehavior;
use metalguardian\fileProcessor\helpers\FPM;
use sport\models\Sport;
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
 * @property string $promo
 * @property string $content
 */
class Coach extends \yii\db\ActiveRecord
{
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
            [['created', 'label', 'country'], 'required'],
            [['created', 'specializationArray', ], 'safe'],
            [['content', 'promo', 'price'], 'string'],
            [['image_id'], 'integer'],
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
            'created' => 'Дата создания',
            'label' => 'Имя',
            'image_id' => 'Изображение',
            'country' => 'Страна',
            'site' => 'Сайт',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'content' => 'Описание',
            'promo' => 'Промо',
            'fb_link' => 'Ссылка facebook',
            'vk_link' => 'Ссылка vkontakte',
            'ig_link' => 'Ссылка instagram',
            'specializationArray' => 'Cпециализации',
        ];
    }


    public function getCoachSport() {
        return $this->hasMany(CoachSportRef::className(), ['coach_id' => 'id']);
    }

    public function getSports() {
        return $this->hasMany(Sport::className(), ['id' => 'sport_id'])->via('coachSport');
    }
}
