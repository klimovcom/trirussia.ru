<?php

namespace training_plan\models;

use Yii;
use sport\models\Sport;
use user\models\User;

class TrainingPlanQuery extends \yii\db\ActiveQuery {

    public function published() {
        return $this->andWhere(['published' => 1]);
    }
}

/**
 * This is the model class for table "training_plan".
 *
 * @property integer $id
 * @property string $label
 * @property string $url
 * @property integer $level
 * @property string $count
 * @property string $amount
 * @property string $progress
 * @property integer $author_id
 * @property string $author_name
 * @property integer $format
 * @property integer $price
 * @property string $duration
 * @property integer $sport_id
 * @property integer $popularity
 * @property string $promo
 * @property string $content
 * @property string $published
 * @property string $author_site
 *
 * @property User $author
 * @property Sport $sport
 */
class TrainingPlan extends \yii\db\ActiveRecord
{

    const LEVEL_BEGINNER = 1;
    const LEVEL_AMATEUR = 2;
    const LEVEL_MIDDLE = 3;
    const LEVEL_UPPER_AMATEUR = 4;
    const LEVEL_SEMI_PRO = 5;

    const FORMAT_PDF = 1;
    const FORMAT_WEBINAR = 2;
    const FORMAT_TRAINING_PEAKS = 3;

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

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'training_plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'url', 'level', 'count', 'amount', 'progress', 'author_name', 'format', 'price', 'duration', 'content', 'sport_id', 'author_id'], 'required'],
            [['level', 'author_id', 'format', 'price', 'sport_id', 'popularity', 'published'], 'integer'],
            [['content', 'promo'], 'string'],
            [['url'], 'unique'],
            [['label', 'url', 'count', 'amount', 'progress', 'author_name', 'duration'], 'string', 'max' => 255],
            [['author_site'], 'string', 'max' => 1024],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
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
            'url' => 'Url',
            'level' => 'Уровень подготовки',
            'count' => 'Количество тренировок в неделю',
            'amount' => 'Обьем тренировок в неделю',
            'progress' => 'Объёмы',
            'author_id' => 'Автор',
            'author_name' => 'Автор плана',
            'author_site' => 'Сайт плана',
            'format' => 'Формат',
            'price' => 'Цена',
            'duration' => 'Длительность',
            'sport_id' => 'Спорт',
            'popularity' => 'Популярность',
            'promo' => 'Промо',
            'content' => 'Информация',
            'published' => 'Опубликовано',
        ];
    }

    public static function find() {
        return new TrainingPlanQuery(get_called_class());
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
    public function getSport()
    {
        return $this->hasOne(Sport::className(), ['id' => 'sport_id']);
    }

    public static function getLevelArray() {
        return [
            self::LEVEL_BEGINNER => 'Новички',
            self::LEVEL_AMATEUR => 'Любители',
            self::LEVEL_MIDDLE => 'Средний',
            self::LEVEL_UPPER_AMATEUR => 'Опытные любители',
            self::LEVEL_SEMI_PRO => 'Почти PRO',
        ];
    }

    public static function getFormatArray() {
        return [
            self::FORMAT_PDF => 'PDF',
            self::FORMAT_WEBINAR => 'Вебинар',
            self::FORMAT_TRAINING_PEAKS => 'Training Peaks',
        ];
    }

    public function getSportClass(){
        return self::$sportClasses[$this->sport_id];
    }
}
