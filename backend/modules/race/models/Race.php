<?php

namespace race\models;

use common\models\User;
use distance\models\Distance;
use distance\models\DistanceCategory;
use distance\models\DistanceDistanceCategoryRef;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\Point;
use Imagine\Imagick\Imagine;
use metalguardian\fileProcessor\behaviors\UploadBehavior;
use metalguardian\fileProcessor\helpers\FPM;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use organizer\models\Organizer;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use omgdef\multilingual\MultilingualTrait;
use yii\validators\FileValidator;
use yii\web\UploadedFile;

/**
 * This is the model class for table "race".
 *
 * @property integer $id
 * @property string $created
 * @property integer $author_id
 * @property string $start_date
 * @property string $finish_date
 * @property string $start_time
 * @property string $country
 * @property string $region
 * @property string $place
 * @property string $label
 * @property string $url
 * @property double $price
 * @property string $currency
 * @property integer $organizer_id
 * @property string $site
 * @property integer $main_image_id
 * @property string $promo
 * @property string $content
 * @property string $instagram_tag
 * @property string $facebook_event_id
 * @property integer $published
 * @property integer $sport_id
 * @property float $coord_lat
 * @property float $coord_lon
 * @property string $special_distance
 * @property integer $display_type
 * @property integer $popularity
 */

class RaceQuery extends \yii\db\ActiveQuery {

    use MultilingualTrait;

    public function forUser() {
        if (Yii::$app->user->isGuest) {
            return null;
        }
        if (Yii::$app->user->identity->getRole() == 'user_role') {
            return $this->andWhere(['author_id' => Yii::$app->user->identity->id]);
        }
        return $this;
    }
}

class Race extends \yii\db\ActiveRecord
{
    const DISPLAY_TYPE_HIDE_IMAGE = 0;
    const DISPLAY_TYPE_BLACK_HIDE_IMAGE = 1;
    const DISPLAY_TYPE_BOTH_SIDES = 2;

    const REGISTER_STATUS_OPEN = 0;
    const REGISTER_STATUS_PAUSED = 1;
    const REGISTER_STATUS_CLOSED = 2;
    const REGISTER_STATUS_CANCELED = 3;

    const MAIN_IMG_WIDTH = 800;
    const MAIN_IMG_HEIGHT = 450;

    public $regulations = [];
    public $traces = [];

    public $organizer_label;

    public static function find() {
        return new RaceQuery(get_called_class());
    }

    public function __construct(array $config = [])
    {
        $this->created = date("Y-m-d H:i", time());
        $this->date_register_begin = mktime(10, 0, 0, date('n'), date('j') + 2);
        $this->date_register_end = mktime(14, 0, 0, date('n'), date('j') + 2);
        $this->author_id = Yii::$app->user->id;
        $this->popularity = 0;
        $this->with_registration = 0;
        $this->racers_limit = 0;
        return parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'race';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'created',
                    'author_id',
                    'country',
                    'region',
                    'label',
                    'url',
                    'content',
                    'organizer_id',
                    'sport_id',
                    'start_date',
                ],
                'required'
            ],
            [
                [
                    'author_id',
                    'organizer_id',
                    'published',
                    'sport_id',
                    'display_type',
                    'popularity',
                    'tristats_race_id',
                    'with_registration', 'register_status', 'racers_limit', 'show_racers_list',
                ],
                'integer'
            ],
            [['date_register_begin', 'date_register_end'], 'safe'],
            [['price', 'coord_lat', 'coord_lon',], 'number'],
            [['promo', 'content', 'special_distance',], 'string'],
            [
                [
                    'start_time',
                    'created',
                    'start_date',
                    'finish_date',
                    'country',
                    'region',
                    'place',
                    'coord_lat',
                    'coord_lon',
                    'regulations',
                    'traces'
                ], 'safe',
            ],
            [['country', 'region'], 'string', 'max' => 100],
            [['organizer_label'], 'string', 'max' => 255],
            [['place', 'label', 'url', 'currency', 'site', 'facebook_event_id', 'contact_phone', 'contact_email'], 'string', 'max' => 255],
            [['contact_email'], 'email', 'when' => function($model) {
                return $model->with_registration == 1;
            }, 'whenClient' => "function(attribute, value) {
                return $('#registration-field').val() == 1;
            }"],
            [['instagram_tag'], 'string', 'max' => 50],
            [['url'], 'unique'],
            [['main_image_id'], 'validateMainImageId', 'skipOnEmpty' => false, 'skipOnError' => false],
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
            'author_id' => 'Автор',
            'sport_id' => 'Вид спорта',
            'start_date' => 'Дата старта',
            'finish_date' => 'Дата финиша',
            'start_time' => 'Время старта',
            'country' => 'Страна',
            'region' => 'Регион',
            'place' => 'Место',
            'label' => 'Название',
            'url' => 'URL',
            'price' => 'Цена',
            'currency' => 'Валюта',
            'organizer_id' => 'Организатор',
            'site' => 'Сайт гонки',
            'main_image_id' => 'Главное изображение',
            'promo' => 'Промо',
            'content' => 'Содержание',
            'instagram_tag' => 'Instagram тег',
            'facebook_event_id' => 'FB Event ID',
            'published' => 'Опубликовано',
            'special_distance' => 'Нестандартная дистанция',
            'display_type' => 'Тип отображения',
            'popularity' => 'Популярность',
            'tristats_race_id' => 'Гонка Tristats.ru',
            'with_registration' => 'Разрешить регистрацию',
            'contact_phone' => 'Контактный телефон',
            'contact_email' => 'Контакный email',
            'date_register_begin' => 'Начало регистрации',
            'date_register_end' => 'Конец регистрации',
            'register_status' => 'Статус регистрации',
            'racers_limit' => 'Лимит участников',
            'show_racers_list' => 'Показывать список участников',
            'regulations' => 'Положения о соревновании',
            'traces' => 'Схемы трасс',
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
                'ml' => [
                    'class' => MultilingualBehavior::className(),
                    'languages' => [
                        'ru' => 'Russian',
                        'en-US' => 'English',
                    ],
                    //'languageField' => 'language',
                    //'localizedPrefix' => '',
                    //'requireTranslations' => false',
                    //'dynamicLangClass' => true',
                    //'langClassName' => RaceLang::className(),
                    'defaultLanguage' => 'ru',
                    'langForeignKey' => 'race_id',
                    'tableName' => "{{%race_lang}}",
                    'attributes' => [
                        'label',
                        'content',
                        'promo',
                        'country',
                        'region',
                        'place',
                        'currency',
                    ]
                ],
            ]
        );
    }

    public function validateMainImageId($attribute, $params) {
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

    public function beforeValidate() {
        $this->date_register_begin = strtotime($this->date_register_begin);
        $this->date_register_end = strtotime($this->date_register_end);

        $this->main_image_id = UploadedFile::getInstance($this, 'main_image_id');

        return parent::beforeValidate();
    }

    public function afterValidate() {
        parent::afterValidate();

        if ($this->hasErrors()) {
            $this->main_image_id = ArrayHelper::getValue($this->oldAttributes, 'main_image_id');
        }
    }


    public function beforeSave($insert) {
        parent::beforeSave($insert);
        $this->addClassToImg('content');
        $this->addClassToImg('content_en');
        $this->saveOrganizer();

        $this->uploadImage();
        return true;
    }

    public function addClassToImg($field) {
        $content = \phpQuery::newDocument($this->$field);
        $imgs = $content->find('img');
        $imgs->addClass('img-fluid');
        $this->$field = $content->html();
    }

    public function beforeDelete()
    {
        parent::beforeDelete();
        FPM::deleteFile($this->main_image_id);

        RaceDistanceRef::deleteAll(['race_id' => $this->id]);
        RaceDistanceCategoryRef::deleteAll(['race_id' => $this->id]);
        RaceRelay::deleteAll(['race_id' => $this->id]);

        foreach ($this->raceRegulations as $file) {
            $file->delete();
        }

        foreach ($this->raceTraces as $file) {
            $file->delete();
        }

        return true; // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $this->saveDistances();
        $this->uploadFiles();

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceDistanceCategoryRefs()
    {
        return $this->hasMany(RaceDistanceCategoryRef::className(), ['race_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceDistanceRefs()
    {
        return $this->hasMany(RaceDistanceRef::className(), ['race_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceRegistrations()
    {
        return $this->hasMany(RaceRegistration::className(), ['race_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisteredUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('race_registration', ['race_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceRegulations()
    {
        return $this->hasMany(RaceFpmFile::className(), ['race_id' => 'id'])->andWhere(['type' => RaceFpmFile::TYPE_REGULATION]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceTraces()
    {
        return $this->hasMany(RaceFpmFile::className(), ['race_id' => 'id'])->andWhere(['type' => RaceFpmFile::TYPE_TRACE]);
    }

    public function getOrganizer() {
        return $this->hasOne(Organizer::className(), ['id' => 'organizer_id']);
    }

    public function getRating() {
        $raceRating = RaceRating::find()->where(['race_id' => $this->id])->all();

        $rating = 0;
        if (count($raceRating)) {
            $rateArr = ArrayHelper::getColumn($raceRating, 'rate');
            $rating = array_sum($rateArr) / count($raceRating);
        }

        return $rating;
    }

    public function getVotersCount() {
        return RaceRating::find()->where(['race_id' => $this->id])->count();
    }

    static function getTypes()
    {
        return [
            self::DISPLAY_TYPE_HIDE_IMAGE => 'Стандартный',
            self::DISPLAY_TYPE_BLACK_HIDE_IMAGE => 'Стандартный на черном фоне',
            self::DISPLAY_TYPE_BOTH_SIDES => 'Двустороннее',
        ];
    }

    static function getRegisterStatus() {
        return [
            self::REGISTER_STATUS_OPEN => 'Открыта',
            self::REGISTER_STATUS_PAUSED => 'Приостановлена',
            self::REGISTER_STATUS_CLOSED => 'Закрыта',
            self::REGISTER_STATUS_CANCELED => 'Отменена',
        ];
    }

    public function getType()
    {
        return isset(self::getTypes()[$this->display_type]) ? self::getTypes()[$this->display_type] : null;
    }

    public function uploadFiles() {
        $attrs = [
            'regulations' => RaceFpmFile::TYPE_REGULATION,
            'traces' => RaceFpmFile::TYPE_TRACE,
        ];

        foreach ($attrs as $attr => $type) {
            $this->$attr = UploadedFile::getInstances($this, $attr);

            foreach ($this->$attr as $file) {
                $model = new RaceFpmFile();
                $model->race_id = $this->id;
                $model->fpm_file_id = FPM::transfer()->saveUploadedFile($file);
                $model->type = $type;
                $model->save();
            }
        }
    }

    public function uploadImage() {
        if ($this->main_image_id instanceof UploadedFile) {
            $this->main_image_id = FPM::transfer()->saveUploadedFile($this->main_image_id);

            $imagine = new Imagine();
            $imageModel = FPM::transfer()->getData($this->main_image_id);
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

            if (!empty(ArrayHelper::getValue($this->oldAttributes, 'main_image_id'))) {
                FPM::deleteFile($this->oldAttributes['main_image_id']);
            }
        }else {
            $this->main_image_id = ArrayHelper::getValue($this->oldAttributes, 'main_image_id');
        }
        return true;
    }

    public function saveDistances() {
        RaceDistanceRef::deleteAll(['race_id' => $this->id]);
        RaceDistanceCategoryRef::deleteAll(['race_id' => $this->id]);
        RaceRelay::deleteAll(['race_id' => $this->id]);
        $raceDistancePostName = (new RaceDistanceRef)->formName();
        $raceDistanceArray = Yii::$app->request->post($raceDistancePostName);

        if (!is_array($raceDistanceArray)) {
            return false;
        }

        $distances = Distance::find()->where(['id' => ArrayHelper::getColumn($raceDistanceArray, 'distance_id')])->all();
        $distanceArray = ArrayHelper::getColumn($distances, 'id');

        $checkArray = [];

        $values = [];
        $relay_values = [];
        foreach ($raceDistanceArray as $raceDistance) {
            $inCheckArray = ArrayHelper::getValue($checkArray, $raceDistance['distance_id'] . '-' . (int) $raceDistance['type']);
            if (in_array($raceDistance['distance_id'], $distanceArray) && $inCheckArray === null) {
                $values[] = [
                    $this->id,
                    $raceDistance['distance_id'],
                    (int) $raceDistance['type'],
                    (int) $raceDistance['price'],
                ];

                $checkArray[$raceDistance['distance_id'] . '-' . (int) $raceDistance['type']] = 1;

                $relays = ArrayHelper::getValue($raceDistance, 'relay');
                if (is_array($relays)) {
                    $i = 1;
                    foreach ($relays as $relay) {
                        $relay_values[] = [
                            $this->id,
                            $raceDistance['distance_id'],
                            (int) $relay['distance'],
                            (int) $relay['sport'],
                            $i,
                        ];
                        $i++;
                    }
                }
            }
        }
        self::getDb()->createCommand()->batchInsert(RaceDistanceRef::tableName(), ['race_id', 'distance_id', 'type', 'price'], $values)->execute();

        self::getDb()->createCommand()->batchInsert(RaceRelay::tableName(), ['race_id', 'distance_id', 'distance', 'sport', 'position'], $relay_values)->execute();

        $distanceCategoryIds = ArrayHelper::getColumn(DistanceDistanceCategoryRef::find()->where(['distance_id' => $distanceArray])->all(), 'distance_category_id');
        $values = [];
        foreach ($distanceCategoryIds as $distance_category_id) {
            $values[] = [$this->id, $distance_category_id];
        }
        self::getDb()->createCommand()->batchInsert(RaceDistanceCategoryRef::tableName(), ['race_id', 'distance_category_id'], $values)->execute();

        return true;
    }

    public function saveOrganizer() {
        $label = $this->organizer_label;
        $organizer = Organizer::find()->where(['label' => $label])->one();
        if (!$organizer) {
            $organizer = new Organizer();
            $organizer->label = $label;
            $organizer->created = date('Y-m-d H:i', time());
            $organizer->save();
        }
        $this->organizer_id = $organizer->id;
    }
}
