<?php

namespace race\models;

use distance\models\Distance;
use distance\models\DistanceCategory;
use metalguardian\fileProcessor\behaviors\UploadBehavior;
use metalguardian\fileProcessor\helpers\FPM;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use organizer\models\Organizer;
use sport\models\Sport;
use willGo\models\WillGo;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

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

    public $distancesArray;
    public $distancesRefs;

    public $categoriesArray;
    public $distanceCategoriesRefs;

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
            [['created', 'author_id', 'start_date', 'start_time', 'country', 'region', 'place', 'label', 'promo'], 'required'],
            [['created', 'start_date', 'finish_date', 'categoriesArray', 'distancesArray', 'main_image_id'], 'safe'],
            [['author_id', 'organizer_id', 'published', 'sport_id', 'display_type'], 'integer'],
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
            'start_date' => 'Дата старта',
            'finish_date' => 'Finish Date',
            'start_time' => 'Время старта',
            'country' => 'Страна',
            'region' => 'Город',
            'place' => 'Место',
            'label' => 'Название',
            'url' => 'Url',
            'price' => 'Стоимость участия',
            'currency' => 'Currency',
            'organizer_id' => 'Организатор',
            'site' => 'Ссылка на официальный сайт',
            'main_image_id' => 'Изображение',
            'promo' => 'Краткое описание (не более 100 знаков)',
            'content' => 'Описание',
            'instagram_tag' => 'Instagram Tag',
            'facebook_event_id' => 'Номер из ссылки на мероприятие в Фейбсуке',
            'published' => 'Published',
            'sport_id' => 'Вид спорта',
            'coord_lon' => 'Coord Lon',
            'coord_lat' => 'Coord Lat',
            'special_distance' => 'Special Distance',
        ];
    }

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
                        'currency',
                    ]
                ],
            ]
        );
    }

    public function __construct(array $config = [])
    {
        $this->created = date("Y-m-d H:i", time());
        $this->start_date = date("Y-m-d", time() + (2 * 60 * 60 * 24));
        $this->start_time = '08:00';
        if (!Yii::$app->user->isGuest) {
            $this->author_id = Yii::$app->user->identity->id;
        }
        $this->url = time() . uniqid(true);
        return parent::__construct($config);
    }

    public function getDistanceCategory()
    {
        $raceDistanceCategoryRefs = $this->raceDistanceCategoryRefs;
        if (empty($raceDistanceCategoryRefs)) return null;
        return $raceDistanceCategoryRefs[0]->distanceCategory->label;
    }

    public function getImageUrl()
    {
        return Url::to(FPM::originalSrc($this->main_image_id), true);
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

    public function getDistancesData()
    {
        $values = [];
        if ($this->isNewRecord) {
            return $values;
        }
        $categoriesRefs = $this->raceDistanceCategoryRefs;
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

    public function getDistancesArrayValues()
    {
        $values = [];
        if ($this->isNewRecord) {
            return $values;
        }
        $refs = $this->getRaceDistanceRefs();
        $distances = ArrayHelper::map(Distance::find()->all(), 'id', 'label');
        foreach ($refs as $ref) {
            $values[$ref->distance_id] = $distances[$ref->distance_id];
        }
        return $values;
    }

    public function getCategoriesArrayValues()
    {
        $categories = ArrayHelper::map(DistanceCategory::find()->all(), 'id', 'label');
        $refs = $this->raceDistanceCategoryRefs;
        $values = [];
        foreach ($refs as $ref) {
            $values[$ref->distance_category_id] = $categories[$ref->distance_category_id];
        }
        return $values;
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        $this->spellCheckFields();
        $this->translateFields();

        return true;
    }

    public function afterSave($insert, $changedAttribures){
        parent::afterSave($insert, $changedAttribures);

        $this->createRaceDistanceCategory($this->categoriesArray);
        $this->createRaceDistance($this->distancesArray);
    }

    public function spellCheckFields() {
        $texts = [
            $this->promo,
            $this->content,
        ];

        $checked = (new \common\components\YandexSpeller($texts))->check();
        if ($checked) {
            $this->promo = array_shift($checked);
            $this->content = array_shift($checked);
            return true;
        }else {
            return false;
        }

    }

    public function translateFields() {
        $this->currency_en = $this->currency;

        $texts = [
            $this->country,
            $this->region,
            $this->place,
            $this->label,
            $this->promo,
            $this->content,
        ];

        $translated = (new \common\components\YandexTranslator($texts))->translate();
        if ($translated) {
            $this->country_en = array_shift($translated);
            $this->region_en = array_shift($translated);
            $this->place_en = array_shift($translated);
            $this->label_en = array_shift($translated);
            $this->promo_en = array_shift($translated);
            $this->content_en = array_shift($translated);

            return true;
        }else {
            return false;
        }
    }

    public function createRaceDistance($distances) {
        if (!is_array($distances)) {
            return false;
        }

        $values = [];

        foreach ($distances as $distance) {
            $values[] = [$this->id, $distance];
        }

        self::getDb()->createCommand()->batchInsert(RaceDistanceRef::tableName(), ['race_id', 'distance_id'], $values)->execute();
        return true;
    }

    public function createRaceDistanceCategory($categories) {
        if (!is_array($categories)) {
            return false;
        }

        $values = [];

        foreach ($categories as $category) {
            $values[] = [$this->id, $category];
        }

        self::getDb()->createCommand()->batchInsert(RaceDistanceCategoryRef::tableName(), ['race_id', 'distance_category_id'], $values)->execute();
        return true;
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

    public function getDateRepresentationScript(){
        return Yii::$app->formatter->asDate($this->start_date, 'yyyy-mm-dd');
    }

    public function getTimeRepresentation(){
        return $this->start_time . ':00';
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

    public function getPlaceRepresentation()
    {
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

    public function getViewUrl()
    {
        return Url::to('/race/' . $this->url);
    }

    public static function getMoreRacesUrl()
    {
        return Url::to('/race/default/get-more-races');
    }

    public static function getMoreRacesIndexTarget()
    {
        return '.block-more-races';
    }

    public static function getMoreRacesTarget()
    {
        return '#card .flex-container';
    }

    public static function getMoreRacesTargetList()
    {
        return '#list tbody';
    }

    public static function getMoreRacesIndexRenderType()
    {
        return 'index';
    }

    public static function getMoreRacesRenderType()
    {
        return 'search';
    }

    public static function getAllRacesByMonths($from, $to)
    {
        if (!\Yii::$app->cache->exists("RacesByMonths[from:$from;to:$to]")){
            \Yii::$app->cache->set(
                "RacesByMonths[from:$from;to:$to]",
                self::getCalculatedAllRacesByMonths($to),
                24*60*60 - 2*60*60
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

    public static function getAllRacesByMonthsAndSport($from, $to)
    {
        $sport = Sport::getCurrentSportModel();

        if (!$sport) return self::getAllRacesByMonths($from, $to);

        $sportUrl = $sport->url;

        \Yii::$app->cache->delete("RacesByMonthsAndSport[from:$from;to:$to:sport:$sportUrl]");
        if (!\Yii::$app->cache->exists("RacesByMonthsAndSport[from:$from;to:$to:sport:$sportUrl]")){
            \Yii::$app->cache->set(
                "RacesByMonthsAndSport[from:$from;to:$to;sport:$sportUrl]",
                self::getCalculatedAllRacesByMonthsAndSport($to),
                24*60*60 - 2*60*60
            );
        }
        return \Yii::$app->cache->get("RacesByMonthsAndSport[from:$from;to:$to;sport:$sportUrl]");
    }

    public static function getCalculatedAllRacesByMonthsAndSport($to)
    {
        $result = [];

        $sport = Sport::getCurrentSportModel();

        $races = Race::find()
            ->select('id, start_date')
            ->where(['between', 'start_date', date('Y-m-d'), date('Y-m-d', strtotime($to . ' -1 day')), ])
            ->andWhere(['sport_id' => $sport->id])
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
                24*60*60 + 3*60*60
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
                24*60*60 + 2*60*60
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

    public static function getAllRacesByCountriesAndSport($from)
    {
        $sport = Sport::getCurrentSportModel();

        if (!$sport) return self::getAllRacesByCountries($from);

        $sportUrl = $sport->url;

        if (!\Yii::$app->cache->exists("RacesByCountriesAndSport[from:$from;sport:$sportUrl]")){
            \Yii::$app->cache->set(
                "RacesByCountriesAndSport[from:$from;sport:$sportUrl]",
                self::getCalculatedAllRacesByCountriesAndSport(),
                24*60*60 + 2*60*60
            );
        }
        return \Yii::$app->cache->get("RacesByCountriesAndSport[from:$from;sport:$sportUrl]");
    }

    public static function getCalculatedAllRacesByCountriesAndSport()
    {
        $result = [];

        $sport = Sport::getCurrentSportModel();

        $races = Race::find()
            ->select('id, country')
            ->where(['>=', 'start_date', date('Y-m-d')])
            ->andWhere(['sport_id'=>$sport->id])
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
                24*60*60 - 60*60
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

    public static function getAllRacesByOrganizersAndSport($from)
    {
        $sport = Sport::getCurrentSportModel();

        if (!$sport) return self::getAllRacesByOrganizers($from);

        $sportUrl = $sport->url;

        if (!\Yii::$app->cache->exists("RacesByOrganizersAndSport[from:$from;sport:$sportUrl]")){
            \Yii::$app->cache->set(
                "RacesByOrganizersAndSport[from:$from;sport:$sportUrl]",
                self::getCalculatedAllRacesByOrganizersAndSport(),
                24*60*60 - 60*60
            );
        }
        return \Yii::$app->cache->get("RacesByOrganizersAndSport[from:$from;sport:$sportUrl]");
    }

    public static function getCalculatedAllRacesByOrganizersAndSport()
    {
        $result = [];

        $sport = Sport::getCurrentSportModel();

        $races = Race::find()
            ->select('id, organizer_id')
            ->where(['>=', 'start_date', date('Y-m-d')])
            ->andWhere(['sport_id'=>$sport->id])
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
                24*60*60 + 60*60
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

    public static function searchForSportPage($sport)
    {
        $raceCondition = Race::find();

        if ($sportModel = Sport::getCurrentSportModel()) {
            $raceCondition->andWhere(['sport_id'  => $sportModel->id ]);
        } else {
            throw new NotFoundHttpException();
        }

        if (!empty($_GET['distance'])){
            $idArray = [];
            $distance = DistanceCategory::find()->where(['label' => $_GET['distance'], 'sport_id'  => $sportModel->id ])->one();
            if (!$distance){
                throw new NotFoundHttpException();
            }
            $refs = RaceDistanceCategoryRef::find()->where(['distance_category_id' => $distance->id, ])->all();
            foreach ($refs as  $ref)
                $idArray[] = $ref->race_id;
            if (!empty($idArray))
                $raceCondition->andWhere(['in', 'race.id', $idArray]);
        }

        if (!empty($_GET['date'])){
            $dateFrom = $_GET['date'] . '-01';
            if (substr($dateFrom, 0, 8) == date('Y-m-')){
                $dateFrom = substr($_GET['date'], 0, 8).date('-d');
            }
            $raceCondition->andWhere(['between', 'start_date', $dateFrom, substr($_GET['date'], 0, 8) . '-31']);
            } else {
            $raceCondition->andWhere(['>=', 'start_date', date('Y-m-d', time())]);
        }

        if (!empty($_GET['country'])) $raceCondition->andWhere(['race.country' => $_GET['country']]);

        if (!empty($_GET['organizer'])){
            $raceCondition->leftJoin('{{%organizer}}', 'organizer_id = organizer.id');
            $raceCondition->andWhere(['organizer.label' => $_GET['organizer']]);
        }

        if (!empty($_GET['sort']) && $_GET['sort'] == 'popular'){
            $races = $raceCondition->orderBy('popularity DESC, start_date ASC, race.id DESC')->limit(13)->all();
        } else {
            $races = $raceCondition->orderBy('start_date ASC, race.id DESC')->limit(13)->all();
        }

        return $races;
    }
}
