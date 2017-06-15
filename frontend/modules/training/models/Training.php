<?php

namespace training\models;

use Yii;
use user\models\User;
use sport\models\Sport;

class TrainingQuery extends \yii\db\ActiveQuery {

    public function published() {
        return $this->andWhere(['published' => 1]);
    }
}

/**
 * This is the model class for table "training".
 *
 * @property integer $id
 * @property string $label
 * @property string $date
 * @property string $time
 * @property integer $place_id
 * @property integer $sport_id
 * @property string $level
 * @property integer $price
 * @property integer $currency
 * @property string $trainer_name
 * @property string $phone
 * @property string $email
 * @property string $promo
 * @property integer $author_id
 * @property integer $published
 *
 * @property User $author
 * @property TrainingPlace $place
 * @property Sport $sport
 */
class Training extends \yii\db\ActiveRecord
{

    const LEVEL_NOVICE = 1;
    const LEVEL_MIDDLE = 2;
    const LEVEL_SEMI_PRO = 3;

    const CURRENCY_RUBBLE = 1;
    const CURRENCY_DOLLAR = 2;
    const CURRENCY_EURO = 3;

    public $levels;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'training';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'date', 'sport_id', 'currency', 'trainer_name', 'phone', 'email', 'author_id', 'published', 'levels'], 'required'],
            [['date'], 'safe'],
            [['place_id', 'sport_id', 'price', 'currency', 'author_id', 'published'], 'integer'],
            [['promo'], 'string'],
            [['email'], 'email'],
            [['label', 'level', 'trainer_name', 'phone', 'email', 'length'], 'string', 'max' => 255],
            [['time'], 'string', 'max' => 5],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => TrainingPlace::className(), 'targetAttribute' => ['place_id' => 'id']],
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
            'label' => 'Название',
            'date' => 'Дата',
            'time' => 'Время',
            'place_id' => 'Место',
            'sport_id' => 'Спорт',
            'level' => 'Уровень',
            'levels' => 'Уровни подготовки',
            'price' => 'Цена',
            'currency' => 'Валюта',
            'trainer_name' => 'Имя тренера',
            'phone' => 'Телефон',
            'email' => 'Почта',
            'promo' => 'Промо',
            'author_id' => 'Автор',
            'published' => 'Опубликовано',
            'length' => 'Длительность',
        ];
    }

    public static function find() {
        return new TrainingQuery(get_called_class());
    }

    public function __construct(array $config = [])
    {
        $this->author_id = Yii::$app->user->id;
        $this->published = 0;
        return parent::__construct($config);
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        $this->level = implode(',', $this->levels);

        return true;
    }

    public function afterFind() {
        parent::afterFind();

        $this->levels = explode(',', $this->level);
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
    public function getPlace()
    {
        return $this->hasOne(TrainingPlace::className(), ['id' => 'place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSport()
    {
        return $this->hasOne(Sport::className(), ['id' => 'sport_id']);
    }

    public static function getLevelArray() {
        return [
            self::LEVEL_NOVICE => 'Начальный',
            self::LEVEL_MIDDLE => 'Средний',
            self::LEVEL_SEMI_PRO => 'Продвинутый',
        ];
    }

    public static function getCurrencyArray() {
        return [
            self::CURRENCY_RUBBLE => 'Рубли',
            self::CURRENCY_DOLLAR => 'Доллары',
            self::CURRENCY_EURO => 'Евро',
        ];
    }

    public function getPriceRepresentation(){
        if ($this->price && $this->currency){
            $currencies = [
                self::CURRENCY_RUBBLE => 'рублей',
                self::CURRENCY_DOLLAR => 'долларов',
                self::CURRENCY_EURO => 'евро',
            ];
            if (!empty($currencies[$this->currency]))
                return $this->price . ' ' . $currencies[$this->currency] . ' с человека';
        }
        return 'Бесплатно';
    }
}
