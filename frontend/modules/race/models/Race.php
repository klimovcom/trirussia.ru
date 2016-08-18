<?php

namespace race\models;

use distance\models\Distance;
use distance\models\DistanceCategory;
use organizer\models\Organizer;
use sport\models\Sport;
use willGo\models\WillGo;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;

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
    const DISPLAY_TYPE_HIDE_IMAGE = 0;
    const DISPLAY_TYPE_BLACK_HIDE_IMAGE = 1;
    const DISPLAY_TYPE_BOTH_SIDES = 2;



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
            $output .= Html::beginTag('li');
            $output .= Html::tag('a', $label, ['class'=>'underline', 'href'=>'#']);
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

    public function getPlaceRepresentation(){
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

    public static function getMoreRacesUrl()
    {
        return Url::to(['/race/default/get-more-races']);
    }

    public static function getAllRacesByMonths($from, $to)
    {
        if (!\Yii::$app->cache->exists("RacesByMonths[from:$from;to:$to]")){
            \Yii::$app->cache->set(
                "RacesByMonths[from:$from;to:$to]",
                self::getCalculatedAllRacesByMonths($to),
                1*24*60*60
            );
        }
        return \Yii::$app->cache->get("RacesByMonths[from:$from;to:$to]");
    }

    public static function getCalculatedAllRacesByMonths($to)
    {
        $result = [];

        $races = Race::find()
            ->select('id, start_date')
            ->where(['between', 'start_date', date('Y-m-d'), date('Y-m-d', strtotime($to . ' -1 day')), ])
            ->all();

        /**
         * @var $race Race
         */
        foreach ($races as $race){
            if (empty($result[date('Y-m', strtotime($race->start_date))])){
                $result[date('Y-m', strtotime($race->start_date))] = 1;
            } else {
                $result[date('Y-m', strtotime($race->start_date))]++;
            }
        }

        return $result;
    }

    public static function getAllRacesBySport($from)
    {
        if (!\Yii::$app->cache->exists("RacesBySports[from:$from]")){
            \Yii::$app->cache->set(
                "RacesBySports[from:$from]",
                self::getCalculatedAllRacesBySports(),
                1.5*24*60*60
            );
        }
        return \Yii::$app->cache->get("RacesBySports[from:$from]");
    }

    public static function getCalculatedAllRacesBySports()
    {
        $result = [];

        $races = Race::find()
            ->select('id, sport_id')
            ->where(['>=', 'start_date', date('Y-m-d')])
            ->all();

        $sports = ArrayHelper::map(Sport::find()->all(), 'id', 'label');


        /**
         * @var $race Race
         */
        foreach ($races as $race){
            if (empty($result[$sports[$race->sport_id]])){
                $result[$sports[$race->sport_id]] = 1;
            } else {
                $result[$sports[$race->sport_id]]++;
            }
        }

        return $result;
    }

    public static function getAllRacesByCountries($from)
    {
        if (!\Yii::$app->cache->exists("RacesByCountries[from:$from]")){
            \Yii::$app->cache->set(
                "RacesByCountries[from:$from]",
                self::getCalculatedAllRacesByCountries(),
                1.4*24*60*60
            );
        }
        return \Yii::$app->cache->get("RacesByCountries[from:$from]");
    }

    public static function getCalculatedAllRacesByCountries()
    {
        $result = [];

        $races = Race::find()
            ->select('id, country')
            ->where(['>=', 'start_date', date('Y-m-d')])
            ->all();


        /**
         * @var $race Race
         */
        foreach ($races as $race){
            if (empty($result[$race->country])){
                $result[$race->country] = 1;
            } else {
                $result[$race->country]++;
            }
        }

        return $result;
    }

    public static function getAllRacesByOrganizers($from)
    {
        if (!\Yii::$app->cache->exists("RacesByOrganizers[from:$from]")){
            \Yii::$app->cache->set(
                "RacesByOrganizers[from:$from]",
                self::getCalculatedAllRacesByOrganizers(),
                1.4*24*60*60
            );
        }
        return \Yii::$app->cache->get("RacesByOrganizers[from:$from]");
    }

    public static function getCalculatedAllRacesByOrganizers()
    {
        $result = [];

        $races = Race::find()
            ->select('id, organizer_id')
            ->where(['>=', 'start_date', date('Y-m-d')])
            ->all();

        $organizers = ArrayHelper::map(Organizer::find()->all(), 'id', 'label');


        /**
         * @var $race Race
         */
        foreach ($races as $race){
            if (empty($result[$organizers[$race->organizer_id]])){
                $result[$organizers[$race->organizer_id]] = 1;
            } else {
                $result[$organizers[$race->organizer_id]]++;
            }
        }

        return $result;
    }

    public static function getAllRacesBySportDistances($from, $sportLabel)
    {
        if (!\Yii::$app->cache->exists("RacesBySportDistances[from:$from;sportLabel:$sportLabel]")){
            \Yii::$app->cache->set(
                "RacesBySportDistances[from:$from;$sportLabel]",
                self::getCalculatedAllRacesBySportDistances($sportLabel),
                1.6*24*60*60
            );
        }
        return \Yii::$app->cache->get("RacesBySportDistances[from:$from;sportLabel:$sportLabel]");
    }

    public static function getCalculatedAllRacesBySportDistances($sportLabel)
    {
        $result = [];

        $sport = Sport::find()->where(['label'=>$sportLabel, ])->one();

        if (!$sportLabel){
            throw new BadRequestHttpException('Не существует такого вида спорта: ' . $sportLabel);
        }

        $distanceCategories = DistanceCategory::find()->where(['sport_id'=>$sport->id])->all();
        $distanceCategoriesIdArray = array_values(ArrayHelper::map($distanceCategories, 'id', 'id'));

        $raceDistanceCategoryRefs = RaceDistanceCategoryRef::find()
            ->where(['in', 'distance_category_id', $distanceCategoriesIdArray])
            ->all();
        $raceIdArray = array_values(ArrayHelper::map($raceDistanceCategoryRefs, 'id', 'race_id'));

        $races = Race::find()
            ->select('id')
            ->where(['>=', 'start_date', date('Y-m-d')])
            ->andWhere(['in', 'id', $raceIdArray])
            ->all();

        $racesImproved = [];


        /** @var DistanceCategory $category */
        foreach ($distanceCategories as $category){
            /** @var RaceDistanceCategoryRef $ref */
            foreach ($raceDistanceCategoryRefs as $ref){
                /** @var Race $race */
                foreach ($races as $race) {
                    if ($category->id == $ref->distance_category_id && $race->id == $ref->race_id){
                        if (empty($result[$category->label])){
                            $result[$category->label] = 1;
                        } else {
                            $result[$category->label]++;
                        }
                    }
                }
            }
        }

        return $result;
    }
}
