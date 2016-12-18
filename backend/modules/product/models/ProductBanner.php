<?php

namespace product\models;

use Yii;

/**
 * This is the model class for table "product_banner".
 *
 * @property integer $id
 * @property string $label
 * @property string $content
 * @property integer $type
 * @property integer $position
 */
class ProductBanner extends \yii\db\ActiveRecord
{

    const TYPE_BEFORE = 0;
    const TYPE_AFTER = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'type'], 'required'],
            [['content'], 'string'],
            [['type', 'position'], 'integer'],
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
            'label' => 'Название',
            'content' => 'Содержание',
            'type' => 'Тип',
            'position' => 'Позиция',
        ];
    }

    public static function getTypeArray() {
        return [
            self::TYPE_BEFORE => 'Перед продуктами',
            self::TYPE_AFTER => 'После продуктов',
        ];
    }
}
