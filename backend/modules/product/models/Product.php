<?php

namespace product\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $created
 * @property string $label
 * @property string $url
 * @property string $promo
 * @property string $content
 * @property integer $image_id
 * @property integer $published
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'label', 'url'], 'required'],
            [['created'], 'safe'],
            [['promo', 'content'], 'string'],
            [[/*'image_id',*/ 'published'], 'integer'],
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
            'created' => 'Created',
            'label' => 'Label',
            'url' => 'Url',
            'promo' => 'Promo',
            'content' => 'Content',
            'image_id' => 'Image ID',
            'published' => 'Published',
        ];
    }
}
