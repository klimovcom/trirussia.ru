<?php

namespace coach\models;

use metalguardian\fileProcessor\behaviors\UploadBehavior;
use metalguardian\fileProcessor\helpers\FPM;
use sport\models\Sport;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;

class CoachQuery extends \yii\db\ActiveQuery {

    public function published() {
        return $this->andWhere(['published' => 1]);
    }

}
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

    public $specializationArray = [];
    public $is_new;
    public $image;

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
            [['created', 'label', 'country', 'url', 'published', 'is_on_moderation'], 'required'],
            [['created', 'specializationArray', 'is_new', 'image_id'], 'safe'],
            [['content', 'promo', 'price'], 'string'],
            [['email'], 'email'],
            [['label', 'country', 'site', 'phone', 'email', 'fb_link', 'vk_link', 'ig_link'], 'string', 'max' => 255],
            [['image'], 'file',
                'extensions' => 'jpg, jpeg, png',
                'maxFiles' => 1,
                'maxSize' => 1024 * 1024 * 10, // 10 MB
                'skipOnEmpty' => false,
                'tooBig' => 'Объем файла больше 10 MB. Пожалуйста, загрузите файл меньшего размера.',
                'wrongMimeType' => 'Можно загружать только JPG и PNG файлы.',
            ],
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
            'image' => 'Изображение',
            'country' => 'Страна',
            'site' => 'Сайт',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'content' => 'Описание',
            'promo' => 'Промо',
            'price' => 'Стоимость',
            'fb_link' => 'Ссылка facebook',
            'vk_link' => 'Ссылка vkontakte',
            'ig_link' => 'Ссылка instagram',
            'specializationArray' => 'Cпециализации',
        ];
    }

    public static function find() {
        return new CoachQuery(get_called_class());
    }

    public function __construct(array $config = [])
    {
        $this->created = date("Y-m-d H:i", time());
        $this->url = time() . uniqid(true);
        $this->published = 0;
        $this->is_on_moderation = 1;
        return parent::__construct($config);
    }

    public function getCoachSport() {
        return $this->hasMany(CoachSportRef::className(), ['coach_id' => 'id']);
    }

    public function getSports() {
        return $this->hasMany(Sport::className(), ['id' => 'sport_id'])->via('coachSport');
    }

    public function getViewUrl() {
        return Url::to(['/coach/default/view', 'url' => $this->url]);
    }

    public function beforeValidate() {
        $this->image = UploadedFile::getInstance($this, 'image');

        return parent::beforeValidate();
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        $this->uploadImage();

        $this->is_new = $this->isNewRecord ? true : false;

        return true;
    }

    public function afterSave($insert, $changedAttribures){
        parent::afterSave($insert, $changedAttribures);

        $this->createCoachSport();

        if ($this->is_new) {
            $this->sendMessage();
        }

    }

    public function sendMessage() {
        Yii::$app->mailer->compose(['text' => 'coach-create'], [
            'model' => $this
        ])
            ->setFrom('no-reply@trirussia.ru')
            ->setTo(Yii::$app->params['supportEmail'])
            ->setSubject('Пользователь создал тренера ' . $this->label)
            ->send();
    }

    public function uploadImage() {
        if ($this->image instanceof UploadedFile) {
            $this->image_id = FPM::transfer()->saveUploadedFile($this->image);
        }
        return true;
    }

    public function createCoachSport() {
        if (!is_array($this->specializationArray)) {
            return false;
        }

        $values = [];

        foreach ($this->specializationArray as $sport_id) {
            $values[] = [$this->id, $sport_id];
        }

        self::getDb()->createCommand()->batchInsert(CoachSportRef::tableName(), ['coach_id', 'sport_id'], $values)->execute();

        return true;

    }
}
