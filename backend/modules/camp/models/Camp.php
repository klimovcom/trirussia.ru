<?php

namespace camp\models;

use Yii;
use sport\models\Sport;
use yii\web\UploadedFile;
use Imagine\Imagick\Imagine;
use Imagine\Image\ImageInterface;
use yii\helpers\ArrayHelper;
use metalguardian\fileProcessor\helpers\FPM;
use yii\validators\FileValidator;
use Imagine\Image\Box;
use Imagine\Image\Point;
use organizer\models\Organizer;

/**
 * This is the model class for table "camp".
 *
 * @property integer $id
 * @property string $label
 * @property string $url
 * @property string $country
 * @property string $region
 * @property string $place
 * @property double $coord_lon
 * @property double $coord_lat
 * @property string $date_start
 * @property string $date_end
 * @property integer $max_user_count
 * @property string $promo
 * @property string $description
 * @property integer $image_id
 * @property integer $price
 * @property integer $currency
 * @property integer $published
 *
 * @property CampSport[] $campSports
 * @property Sport[] $sports
 */
class Camp extends \yii\db\ActiveRecord
{

    const CURRENCY_RUBLE = 0;
    const CURRENCY_DOLLAR = 1;
    const CURRENCY_EURO = 2;

    const MAIN_IMG_WIDTH = 800;
    const MAIN_IMG_HEIGHT = 450;

    public $sportArray;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'camp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'url', 'country', 'region', 'place', 'promo', 'description', 'published', 'organizer_id'], 'required'],
            [['coord_lon', 'coord_lat'], 'number'],
            [['date_start', 'date_end', 'sportArray'], 'safe'],
            [['max_user_count', 'price', 'currency', 'published', 'organizer_id', 'is_accommodation'], 'integer'],
            [['promo', 'description'], 'string'],
            [['label', 'url', 'country', 'region', 'place'], 'string', 'max' => 255],
            [['image_id'], 'validateImageId', 'skipOnEmpty' => false, 'skipOnError' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Название',
            'url' => 'Url',
            'country' => 'Страна',
            'region' => 'Город',
            'place' => 'Место',
            'coord_lon' => 'Coord Lon',
            'coord_lat' => 'Coord Lat',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
            'organizer_id' => 'Организатор',
            'max_user_count' => 'Количество человек',
            'promo' => 'Промо',
            'description' => 'Описание',
            'image_id' => 'Изображение',
            'price' => 'Цена',
            'currency' => 'Валюта',
        ];
    }

    public function __construct(array $config = [])
    {
        $this->published = 0;
        return parent::__construct($config);
    }

    public function beforeValidate() {

        $this->image_id = UploadedFile::getInstance($this, 'image_id');

        return parent::beforeValidate();
    }

    public function afterValidate() {
        parent::afterValidate();

        if ($this->hasErrors()) {
            $this->image_id = ArrayHelper::getValue($this->oldAttributes, 'image_id');
        }
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        $this->uploadImage();
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $this->saveSports();

        return true;
    }

    public function beforeDelete()
    {
        parent::beforeDelete();
        FPM::deleteFile($this->image_id);

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampSports()
    {
        return $this->hasMany(CampSport::className(), ['camp_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSports()
    {
        return $this->hasMany(Sport::className(), ['id' => 'sport_id'])->viaTable('camp_sport', ['camp_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizer()
    {
        return $this->hasOne(Organizer::className(), ['id' => 'organizer_id']);
    }

    public static function getCurrencyArray() {
        return [
            self::CURRENCY_RUBLE => 'Рубль',
            self::CURRENCY_DOLLAR => 'Доллар',
            self::CURRENCY_EURO => 'Eвро',
        ];
    }

    public function uploadImage() {
        if ($this->image_id instanceof UploadedFile) {
            $this->image_id = FPM::transfer()->saveUploadedFile($this->image_id);

            $imagine = new Imagine();
            $imageModel = FPM::transfer()->getData($this->image_id);
            $imagePath = FPM::getOriginalDirectory($imageModel->id) . DIRECTORY_SEPARATOR .FPM::getOriginalFileName($imageModel->id, $imageModel->base_name, $imageModel->extension);

            $image = $imagine->open($imagePath);
            $image->interlace(ImageInterface::INTERLACE_PLANE);

            $neededAspectRatio = self::MAIN_IMG_WIDTH / self::MAIN_IMG_HEIGHT;
            $imageAspectRatio = $image->getSize()->getWidth() / $image->getSize()->getHeight();

            if ($neededAspectRatio > $imageAspectRatio) {
                $size = $image->getSize()->widen(self::MAIN_IMG_WIDTH);
            }else {
                $size = $image->getSize()->heighten(self::MAIN_IMG_HEIGHT);
            }
            $image->resize($size, ImageInterface::FILTER_SINC);


            if ($image->getSize()->getWidth() > self::MAIN_IMG_WIDTH || $image->getSize()->getHeight() > self::MAIN_IMG_HEIGHT) {
                $cropBox = new Box(self::MAIN_IMG_WIDTH, self::MAIN_IMG_HEIGHT);
                $cropPoint = new Point(($image->getSize()->getWidth() - self::MAIN_IMG_WIDTH) / 2, ($image->getSize()->getHeight() - self::MAIN_IMG_HEIGHT) / 2);
                $image->crop($cropPoint, $cropBox);
            }

            $image->getImagick()->setImageCompressionQuality(70);
            $image->getImagick()->setImageFormat('jpg');
            $image->getImagick()->stripImage();

            $image->save($imagePath);

            if (!empty(ArrayHelper::getValue($this->oldAttributes, 'image_id'))) {
                FPM::deleteFile($this->oldAttributes['image_id']);
            }
        }else {
            $this->image_id = ArrayHelper::getValue($this->oldAttributes, 'image_id');
        }
        return true;
    }

    public function validateImageId($attribute, $params) {
        if ($this->$attribute instanceof UploadedFile) {
            $validator = new FileValidator();
            $validator->extensions = ['png', 'jpg'];
            $validator->maxFiles = 1;
            if (!$validator->validate($this->$attribute, $error)) {
                $this->addError($attribute, $error);
            }
        }elseif (empty(ArrayHelper::getValue($this->oldAttributes, $attribute))) {
            $this->addError($attribute, 'Загрузите файл');
        }
    }

    public function saveSports() {
        CampSport::deleteAll(['camp_id' => $this->id]);
        $values = [];
        if (!is_array($this->sportArray)) {
            return false;
        }
        foreach ($this->sportArray as $sport) {
            $values[] = [$this->id, $sport];
        }

        self::getDb()->createCommand()->batchInsert(CampSport::tableName(), ['camp_id', 'sport_id'], $values)->execute();
        return true;
    }
}
