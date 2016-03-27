<?php

namespace race\models;

use metalguardian\fileProcessor\behaviors\UploadBehavior;
use metalguardian\fileProcessor\helpers\FPM;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use Yii;
use yii\helpers\ArrayHelper;

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
 */
class Race extends \yii\db\ActiveRecord
{
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
            [['created', 'author_id', 'start_date', 'country', 'region', 'label', 'url', 'promo', 'organizer', 'sport_id'], 'required'],
            [['created', 'start_date', 'finish_date'], 'safe'],
            [['author_id', 'organizer_id', /*'main_image_id',*/
                'published', 'sport_id',], 'integer'],
            [['price',], 'number'],
            [['promo', 'content'], 'string'],
            [['start_time'], 'string', 'max' => 5],
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
            'created' => 'Создана',
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
            'facebook_event_id' => 'Facebook event ID',
            'published' => 'Опубликовано',
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
                    //'langClassName' => PostLang::className(), // or namespace/for/a/class/PostLang
                    'defaultLanguage' => 'ru',
                    'langForeignKey' => 'race_id',
                    'tableName' => "{{%race_lang}}",
                    'attributes' => [
                        'label', 'content', 'promo', 'country', 'region', 'place', 'currency'
                    ]
                ],
            ]
        );
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        parent::beforeDelete();

        FPM::deleteFile($this->main_image_id);

        return true;
    }
}
