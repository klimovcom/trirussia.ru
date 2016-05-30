<?php

namespace sport\models;

use Yii;

/**
 * This is the model class for table "sport".
 *
 * @property integer $id
 * @property string $label
 * @property string $url
 * @property boolean $is_on_main
 */
class Sport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'url', ], 'string', 'max' => 255],
            [['url',], 'unique'],
            [['is_on_main', ], 'integer'],
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
            'url' => 'Название в URL',
            'is_on_main' => 'На главной',
        ];
    }
}
