<?php

namespace page\models;

use Yii;

/**
 * This is the model class for table "content_page".
 *
 * @property integer $id
 * @property string $created
 * @property string $label
 * @property string $content
 * @property string $url
 * @property integer $published
 */
class Page extends \yii\db\ActiveRecord
{
    public function __construct(array $config = [])
    {
        $this->created = date("Y-m-d H:i", time());
        return parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'label', 'content', 'url'], 'required'],
            [['created'], 'safe'],
            [['content'], 'string'],
            [['published'], 'integer'],
            [['label', 'url'], 'string', 'max' => 255],
            [['url'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Создана',
            'label' => 'Заголовок',
            'content' => 'Содержание',
            'url' => 'URL',
            'published' => 'Опубликовано',
        ];
    }
}
