<?php

namespace race\models;

use distance\models\Distance;
use distance\models\DistanceCategory;
use distance\models\DistanceDistanceCategoryRef;
use metalguardian\fileProcessor\behaviors\UploadBehavior;
use metalguardian\fileProcessor\helpers\FPM;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

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
 */
class Race extends \yii\db\ActiveRecord
{
    protected $distancesArray;
    public $distancesRefs;

    protected $categoriesArray;
    public $distanceCategoriesRefs;

    public function setCategoriesArray($value)
    {
        $this->categoriesArray = $value;
    }

    public function setDistancesArray($value)
    {
        $this->distancesArray = $value;
    }


    public function getDistanceCategoriesRefs()
    {
        if ($this->isNewRecord) {
            return [];
        }
        if (!$this->distanceCategoriesRefs) {
            $this->distanceCategoriesRefs = RaceDistanceCategoryRef::findAll(['race_id' => $this->id]);
        }
        return $this->distanceCategoriesRefs;
    }

    public function getDistancesRefs()
    {
        if ($this->isNewRecord) {
            return [];
        }
        if (!$this->distancesRefs) {
            $this->distancesRefs = RaceDistanceRef::findAll(['race_id' => $this->id]);
        }
        return $this->distancesRefs;
    }

    public function getCategoriesArrayValues()
    {
        $categories = ArrayHelper::map(DistanceCategory::find()->all(), 'id', 'label');
        $refs = $this->getDistanceCategoriesRefs();
        $values = [];
        foreach ($refs as $ref) {
            $values[$ref->distance_category_id] = $categories[$ref->distance_category_id];
        }
        return $values;
    }

    public function getCategoriesArray()
    {
        if ($this->categoriesArray === null) {
            $refs = $this->getDistanceCategoriesRefs();
            foreach ($refs as $ref) {
                $this->categoriesArray[] = $ref->distance_category_id;
            }
        }
        return is_array($this->categoriesArray) ? $this->categoriesArray : [];
    }

    public function getDistancesArray()
    {
        if ($this->distancesArray === null) {
            $refs = $this->getDistancesRefs();
            foreach ($refs as $ref) {
                $this->distancesArray[] = $ref->distance_id;
            }
        }
        return is_array($this->distancesArray) ? $this->distancesArray : [];
    }

    public function getDistancesArrayValues()
    {
        $values = [];
        if ($this->isNewRecord) {
            return $values;
        }
        $refs = $this->getDistancesRefs();
        $distances = ArrayHelper::map(Distance::find()->all(), 'id', 'label');
        foreach ($refs as $ref) {
            $values[$ref->distance_id] = $distances[$ref->distance_id];
        }
        return $values;
    }

    public function getDistancesData()
    {
        $values = [];
        if ($this->isNewRecord) {
            return $values;
        }
        $categoriesRefs = $this->getDistanceCategoriesRefs();
        $categoriesIdArray = [];
        foreach ($categoriesRefs as $ref) {
            $categoriesIdArray[] = $ref->distance_category_id;
        }
        $distancesRefs = DistanceDistanceCategoryRef::find()
            ->where(['in', 'distance_category_id', $categoriesIdArray])
            ->all();
        $distances = ArrayHelper::map(Distance::find()->all(), 'id', 'label');
        foreach ($distancesRefs as $ref) {
            $values[$ref->distance_id] = $distances[$ref->distance_id];
        }
        return $values;
    }

    public function __construct(array $config = [])
    {
        $this->created = date("Y-m-d H:i", time());
        $this->author_id = Yii::$app->user->id;
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
                    'start_date'
                ],
                'required'
            ],
            [
                [
                    'author_id',
                    'organizer_id',
                    'published',
                    'sport_id',
                ],
                'integer'
            ],
            [['price', 'coord_lat', 'coord_lon',], 'number'],
            [['promo', 'content', 'special_distance',], 'string'],
            [
                [
                    'start_time',
                    'categoriesArray',
                    'distancesArray',
                    'created',
                    'start_date',
                    'finish_date',
                    'country',
                    'region',
                    'place',
                    'coord_lat',
                    'coord_lon',
                ], 'safe',
            ],
            [['country', 'region'], 'string', 'max' => 100],
            [['place', 'label', 'url', 'currency', 'site', 'facebook_event_id'], 'string', 'max' => 255],
            [['instagram_tag'], 'string', 'max' => 50],
            [['url'], 'unique']
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
            'site' => 'Сайт',
            'main_image_id' => 'Главное изображение',
            'promo' => 'Промо',
            'content' => 'Содержание',
            'instagram_tag' => 'Instagram тег',
            'facebook_event_id' => 'FB Event ID',
            'published' => 'Опубликовано',
            'special_distance' => 'Нестандартная дистанция',
            'categoriesArray' => 'Категории дистанций',
            'distancesArray' => 'Дистанции',
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
                'main_image_id' => [
                    'class' => UploadBehavior::className(),
                    'attribute' => 'main_image_id',
                    'image' => true,
                    'required' => true,
                ],
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
                        'currency'
                    ]
                ],
            ]
        );
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public function beforeValidate()
    {
        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public function beforeDelete()
    {
        parent::beforeDelete();
        FPM::deleteFile($this->main_image_id);
        $refs = $this->getDistanceCategoriesRefs();
        foreach ($refs as $ref) {
            $ref->delete();
        }
        $refs = $this->getDistancesRefs();
        foreach ($refs as $ref) {
            $ref->delete();
        }
        return true; // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        $refs = $this->getDistanceCategoriesRefs();
        foreach ($refs as $ref) {
            $ref->delete();
        }
        if (is_array($this->categoriesArray)) {
            foreach ($this->categoriesArray as $categoryId) {
                $newRef = new RaceDistanceCategoryRef();
                $newRef->race_id = $this->id;
                $newRef->distance_category_id = $categoryId;
                $newRef->save();
            }
        }
        if (is_array($this->distancesArray)) {
            foreach ($this->distancesArray as $distanceId) {
                $newRef = new RaceDistanceRef();
                $newRef->race_id = $this->id;
                $newRef->distance_id = $distanceId;
                $newRef->save();
            }
        }
        return true;
    }
}
