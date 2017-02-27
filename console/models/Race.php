<?php

namespace console\models;

use Yii;
use yii\helpers\ArrayHelper;
use omgdef\multilingual\MultilingualBehavior;

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
 * @property double $coord_lon
 * @property double $coord_lat
 * @property string $special_distance
 * @property integer $popularity
 * @property integer $display_type
 *
 */
class Race extends \yii\db\ActiveRecord
{
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
            [['created', 'author_id', 'start_date', 'country', 'region', 'label', 'url', 'promo'], 'required'],
            [['created', 'start_date', 'finish_date'], 'safe'],
            [['author_id', 'organizer_id', 'main_image_id', 'published', 'sport_id', 'popularity', 'display_type', 'tristats_race_id'], 'integer'],
            [['price', 'coord_lon', 'coord_lat'], 'number'],
            [['promo', 'content'], 'string'],
            [['start_time'], 'string', 'max' => 5],
            [['country', 'region'], 'string', 'max' => 100],
            [['place', 'label', 'url', 'currency', 'site', 'facebook_event_id', 'special_distance'], 'string', 'max' => 255],
            [['instagram_tag'], 'string', 'max' => 50],
            [['url'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Created',
            'author_id' => 'Author ID',
            'start_date' => 'Start Date',
            'finish_date' => 'Finish Date',
            'start_time' => 'Start Time',
            'country' => 'Country',
            'region' => 'Region',
            'place' => 'Place',
            'label' => 'Label',
            'url' => 'Url',
            'price' => 'Price',
            'currency' => 'Currency',
            'organizer_id' => 'Organizer ID',
            'site' => 'Site',
            'main_image_id' => 'Main Image ID',
            'promo' => 'Promo',
            'content' => 'Content',
            'instagram_tag' => 'Instagram Tag',
            'facebook_event_id' => 'Facebook Event ID',
            'published' => 'Published',
            'sport_id' => 'Sport ID',
            'coord_lon' => 'Coord Lon',
            'coord_lat' => 'Coord Lat',
            'special_distance' => 'Special Distance',
            'popularity' => 'Popularity',
            'display_type' => 'Display Type',
        ];
    }

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
}
