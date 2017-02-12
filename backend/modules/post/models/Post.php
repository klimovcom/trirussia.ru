<?php

namespace post\models;

use metalguardian\fileProcessor\behaviors\UploadBehavior;
use metalguardian\fileProcessor\helpers\FPM;
use Yii;
use yii\helpers\ArrayHelper;

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
 * @property string $tags
 * @property bool $featured
 * @property integer $published
 */
class Post extends \yii\db\ActiveRecord
{
    const TYPE_NEW = 0;
    const TYPE_REPORT = 1;
    const TYPE_INTERVIEW = 2;
    const TYPE_REVIEW = 3;

    public function __construct(array $config = [])
    {
        $this->created = date("Y-m-d H:i", time());
        $this->author_id = Yii::$app->user->id;
        $this->popularity = 0;
        return parent::__construct($config);
    }

    public static function getTypes()
    {
        return [
            self::TYPE_NEW => 'Новости',
            self::TYPE_REPORT => 'Отчет',
            self::TYPE_INTERVIEW => 'Интервью',
            self::TYPE_REVIEW => 'Обзор',
        ];
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
            [['created', 'author_id', 'label', 'url', 'promo', 'content', ], 'required'],
            [['created'/*, 'image_id'*/,], 'safe'],
            [['author_id', 'type', 'published', 'featured', ], 'integer'],
            [['promo', 'content', 'tags', ], 'string'],
            [['label', 'url'], 'string', 'max' => 255],
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
            'created' => 'Дата создания',
            'author_id' => 'Автор',
            'label' => 'Заголовок',
            'url' => 'URL',
            'promo' => 'Промо',
            'content' => 'Содержание',
            'image_id' => 'Изображение',
            'type' => 'Тип публикации',
            'popularity' => 'Популярность',
            'featured' => 'Выделенная',
            'tags' => 'Теги',
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
                'image_id' => [
                    'class' => UploadBehavior::className(),
                    'attribute' => 'image_id',
                    'image' => true,
                    'required' => true,
                ],
                'seo' => [
                    'class' => 'seo\components\SeoModelBehavior'
                ],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        parent::beforeDelete();

        FPM::deleteFile($this->image_id);

        return true;
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);
        $this->addClassToImg('content');
        return true;
    }

    public function addClassToImg($field) {
        $content = \phpQuery::newDocument($this->$field);
        $imgs = $content->find('img');
        $imgs->addClass('img-fluid');
        $this->$field = $content->html();
    }
}
