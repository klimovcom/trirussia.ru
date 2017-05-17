<?php

namespace camp\models;

use Yii;
use sport\models\Sport;
use metalguardian\fileProcessor\helpers\FPM;
use organizer\models\Organizer;

class CampQuery extends \yii\db\ActiveQuery {

    public function published() {
        return $this->andWhere(['published' => 1]);
    }

}
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
 * @property integer $is_accommodation
 *
 * @property CampSport[] $campSports
 * @property Sport[] $sports
 */
class Camp extends \yii\db\ActiveRecord
{

    const CURRENCY_RUBLE = 0;
    const CURRENCY_DOLLAR = 1;
    const CURRENCY_EURO = 2;

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
            [['max_user_count', 'price', 'currency', 'published', 'organizer_id'], 'integer'],
            [['promo', 'description'], 'string'],
            [['label', 'url', 'country', 'region', 'place'], 'string', 'max' => 255],
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
            'max_user_count' => 'Количество человек',
            'promo' => 'Промо',
            'description' => 'Описание',
            'image_id' => 'Изображение',
            'price' => 'Цена',
            'currency' => 'Валюта',
        ];
    }

    public static function find() {
        return new CampQuery(get_called_class());
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

    public function getPriceRepresentation(){
        if ($this->price && $this->currency){
            $currencies = [
                self::CURRENCY_RUBLE => 'рублей',
                self::CURRENCY_DOLLAR => 'долларов',
                self::CURRENCY_EURO => 'евро',
            ];
            if (!empty($currencies[$this->currency]))
                return $this->price . ' ' . $currencies[$this->currency];
        }
        return null;
    }

    public function getDaysRepresentation() {
        $diff = (strtotime($this->date_end) - strtotime($this->date_start))/(60*60*24);

        $n = abs($diff) % 100;
        $n1 = $n % 10;

        if ($n > 10 && $n < 20) {
            return $diff .' дней';
        }

        if ($n1 > 1 && $n1 < 5) {
            return $diff .' дня';
        }

        if ($n1 == 1) {
            return $diff .' день';
        }

        return $diff .' дней';
    }
}
