<?php

namespace race\models;

use distance\models\Distance;
use organizer\models\Organizer;
use sport\models\Sport;
use willGo\models\WillGo;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
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
 * @property double $coord_lon
 * @property double $coord_lat
 * @property string $special_distance
 * @property integer $display_type
 * @property integer $popularity
 *
 * @property Organizer $organizer
 * @property Sport $sport
 * @property RaceDistanceCategoryRef[] $raceDistanceCategoryRefs
 * @property RaceDistanceRef[] $raceDistanceRefs
 * @property RaceLang[] $raceLangs
 */
class Race extends \yii\db\ActiveRecord
{
    const DISPLAY_TYPE_STANDARD = 0;
    const DISPLAY_TYPE_HIDE_IMAGE = 1;
    const DISPLAY_TYPE_BLACK_HIDE_IMAGE = 2;
    const DISPLAY_TYPE_BOTH_SIDES = 3;



    static $sportClasses = [
        1 => 'tri',
        2 => 'run',
        3 => 'swim',
        4 => 'review',
        5 => 'news',
        6 => 'report',
        7 => 'bike',
        8 => 'interview',
    ];

    static protected $maxPopularity;

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
            [['author_id', 'organizer_id', 'main_image_id', 'published', 'sport_id', 'display_type'], 'integer'],
            [['price', 'coord_lon', 'coord_lat', 'popularity'], 'number'],
            [['promo', 'content'], 'string'],
            [['start_time'], 'string', 'max' => 5],
            [['country', 'region'], 'string', 'max' => 100],
            [['place', 'label', 'url', 'currency', 'site', 'facebook_event_id', 'special_distance'], 'string', 'max' => 255],
            [['instagram_tag'], 'string', 'max' => 50],
            [['url'], 'unique'],
            [['organizer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organizer::className(), 'targetAttribute' => ['organizer_id' => 'id']],
            [['sport_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sport::className(), 'targetAttribute' => ['sport_id' => 'id']],
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
        ];
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
        return RaceDistanceRef::find()->where(['race_id' => $this->id])->all() ;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaceLangs()
    {
        return $this->hasMany(RaceLang::className(), ['race_id' => 'id']);
    }

    public function getDateRepresentation(){
        return Yii::$app->formatter->asDate($this->start_date, 'd MMMM yyyy') . ' г.';
    }

    public function getPlaceTimePromo(){
        $data = [];
        if ($date = $this->getDateRepresentation())
            array_push($data, $date);
        if (!empty($this->country))
            array_push($data, $this->country);
        if (!empty($this->city))
            array_push($data, $this->city);
        if (!empty($this->place))
            array_push($data, $this->place);
        return implode(', ', $data);
    }
    
    public function getDistancesRepresentation(){
        $idArr = [];
        foreach ($this->getRaceDistanceRefs() as $ref){
            $idArr[] = $ref->distance_id;
        }
        $distances = Distance::find()->where(['in', 'id', $idArr])->all();

        $labels = ArrayHelper::map($distances, 'id', 'label');
        return implode(', ', $labels);
    }

    public function getDistancesListRepresentation(){
        $idArr = [];
        foreach ($this->getRaceDistanceRefs() as $ref){
            $idArr[] = $ref->distance_id;
        }
        $distances = Distance::find()->where(['in', 'id', $idArr])->all();

        $labels = ArrayHelper::map($distances, 'id', 'label');
        $output = Html::beginTag('ul', ['class' => 'list-unstyled']);
        foreach ($labels as $label){
            $output .= Html::beginTag('il');
            $output .= Html::tag('a', $label, ['href'=>'#']);
            $output .= Html::endTag('li');
        }
        $output .= Html::endTag('ul');
        return $output;
    }

    public function getPriceRepresentation(){
        if ($this->price && $this->currency){
            $currencies = [
                'рубли' => 'рублей',
                'доллары' => 'долларов',
                'евро' => 'евро',
            ];
            if (!empty($currencies[$this->currency]))
                return $this->price . ' ' . $currencies[$this->currency];
        }
        return null;
    }

    public function getSportClass(){
        return self::$sportClasses[$this->sport_id];
    }

    public function addStatisticsView(){
        $this->popularity++;
        $this->save();
    }

    public function getPlaceRepresetation(){
        $output = Html::tag('a', $this->country, ['class'=>'underline', 'href'=>'#']);
        $output .= $this->region ? ', ' . $this->region : '';
        $output .= $this->place ? ', ' . $this->place : '';
        return $output;
    }

    public function getPopularityRepresentation($img = 'img/rating.png'){
        $maxPopularity = self::getMaxPopularity();
        $rank = 1;
        if ($maxPopularity > 0){
            $step = $maxPopularity/5;
            if ($this->popularity>$step){
                $rank = $this->popularity/$step;
            }
        }
        $output = '';
        for($i = 0; $i<$rank; $i++){
            $output .= Html::img($img, ['class'=>'rating']);
        }
        return $output;
    }

    public static function getMaxPopularity(){
        if (self::$maxPopularity === null){
            $maxPopularityModel = Race::find()->orderBy('popularity DESC')->one();
            self::$maxPopularity = $maxPopularityModel->popularity;
        }
        return self::$maxPopularity;
    }

    public function isShowImage()
    {
        if ($this->display_type == self::DISPLAY_TYPE_BLACK_HIDE_IMAGE
            OR $this->display_type == self::DISPLAY_TYPE_HIDE_IMAGE){

            return false;
        }

        return true;
    }

    public function isJoined()
    {
        if (Yii::$app->user->isGuest)
            return false;
        $userId = Yii::$app->user->identity->id;
        $willGo = WillGo::find()->where(['race_id' => $this->id, 'user_id' => $userId])->one();
        if ($willGo)
            return true;
        return false;

    }
}
