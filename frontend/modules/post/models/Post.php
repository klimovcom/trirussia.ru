<?php

namespace post\models;

use metalguardian\fileProcessor\helpers\FPM;
use user\models\User;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $created
 * @property integer $author_id
 * @property string $label
 * @property string $url
 * @property string $promo
 * @property string $content
 * @property integer $image_id
 * @property integer $type
 * @property integer $popularity
 * @property integer $published
 *
 * @property User $author
 */

class PostQuery extends \yii\db\ActiveQuery {

    public function published() {
        return $this->andWhere(['published' => 1]);
    }

}

class Post extends \yii\db\ActiveRecord
{
    const TYPE_NEW = 0;
    const TYPE_REPORT = 1;
    const TYPE_INTERVIEW = 2;
    const TYPE_REVIEW = 3;

    public static function getTypes()
    {
        return [
            self::TYPE_NEW => 'Новости',
            self::TYPE_REPORT => 'Отчет',
            self::TYPE_INTERVIEW => 'Интервью',
            self::TYPE_REVIEW => 'Обзор',
        ];
    }

    public function getImageUrl()
    {
        return FPM::originalSrc($this->image_id);
    }

    public function getType()
    {
        return isset(self::getTypes()[(int)$this->type]) ? self::getTypes()[(int)$this->type] : null;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'author_id', 'label', 'url', 'promo', 'content', 'image_id'], 'required'],
            [['created'], 'safe'],
            [['author_id', 'image_id', 'published', 'popularity'], 'integer'],
            [['promo', 'content'], 'string'],
            [['label', 'url'], 'string', 'max' => 255],
            [['url'], 'unique'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
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
            'label' => 'Label',
            'url' => 'Url',
            'promo' => 'Promo',
            'content' => 'Content',
            'image_id' => 'Image ID',
            'published' => 'Published',
        ];
    }

    public static function find() {
        return new PostQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function addStatisticsView(){
        $this->updateCounters(['popularity' => 1]);
    }

    public function getViewUrl() {
        return Url::to(['/post/default/view', 'url' => $this->url]);
    }
}
