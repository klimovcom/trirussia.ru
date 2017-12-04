<?php

namespace api\modules\race\models;

use api\modules\organizer\models\Organizer;
use api\modules\race\queries\RaceQuery;
use api\modules\sport\models\Sport;
use Yii;

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
 * @property integer $tristats_race_id
 * @property integer $with_registration
 * @property string $contact_phone
 * @property string $contact_email
 * @property integer $date_register_begin
 * @property integer $date_register_end
 * @property integer $register_status
 * @property integer $racers_limit
 * @property integer $show_racers_list
 * @property integer $is_sended_email_to_author
 *
 * @property Organizer $organizer
 * @property Sport $sport
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
            [['author_id', 'organizer_id', 'main_image_id', 'published', 'sport_id', 'popularity', 'display_type', 'tristats_race_id', 'with_registration', 'date_register_begin', 'date_register_end', 'register_status', 'racers_limit', 'show_racers_list', 'is_sended_email_to_author'], 'integer'],
            [['price', 'coord_lon', 'coord_lat'], 'number'],
            [['promo', 'content'], 'string'],
            [['start_time'], 'string', 'max' => 5],
            [['country', 'region'], 'string', 'max' => 100],
            [['place', 'label', 'url', 'currency', 'site', 'facebook_event_id', 'special_distance', 'contact_phone', 'contact_email'], 'string', 'max' => 255],
            [['instagram_tag'], 'string', 'max' => 50],
            [['url'], 'unique'],
            [['organizer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organizer::className(), 'targetAttribute' => ['organizer_id' => 'id']],
            [['sport_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sport::className(), 'targetAttribute' => ['sport_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new RaceQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizer()
    {
        return $this->hasOne(Organizer::className(), ['id' => 'organizer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSport()
    {
        return $this->hasOne(Sport::className(), ['id' => 'sport_id']);
    }
}
