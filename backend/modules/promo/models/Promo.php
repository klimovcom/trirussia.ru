<?php

namespace promo\models;

use Yii;

/**
 * This is the model class for table "promo".
 *
 * @property integer $id
 * @property string $label
 * @property string $content
 * @property integer $position
 * @property integer $published
 * @property integer $created
 */
class Promo extends \yii\db\ActiveRecord
{
    public function __construct(array $config = [])
    {
        $this->created = date("Y-m-d H:i", time());
        $this->published = 1;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'created'], 'string'],
            [['position', 'published', ], 'integer'],
            [['label'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Заголовок',
            'content' => 'Текст',
            'position' => 'Позиция',
            'published' => 'Опубликован',
            'created' => 'Дата создания',
        ];
    }
}
