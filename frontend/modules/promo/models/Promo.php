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
 * @property string $created
 */
class Promo extends \yii\db\ActiveRecord
{
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
            [['content'], 'string'],
            [['position', 'published'], 'integer'],
            [['created'], 'required'],
            [['created'], 'safe'],
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
            'label' => 'Label',
            'content' => 'Content',
            'position' => 'Position',
            'published' => 'Published',
            'created' => 'Created',
        ];
    }
}
