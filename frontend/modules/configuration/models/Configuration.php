<?php

namespace configuration\models;

use Yii;

/**
 * This is the model class for table "configuration".
 *
 * @property integer $id
 * @property string $label
 * @property string $description
 * @property string $key
 * @property string $value
 */
class Configuration extends \yii\db\ActiveRecord
{
    private static $_preload = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'configuration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'key'], 'required'],
            [['description'], 'string'],
            [['label', 'key', 'value'], 'string', 'max' => 255],
            [['key'], 'unique'],
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
            'description' => 'Description',
            'key' => 'Key',
            'value' => 'Value',
        ];
    }

    public static function getPreload()
    {
        if (self::$_preload === false ){
            self::$_preload = Configuration::find()->all();
        }
        return self::$_preload;
    }

    public static function get($key)
    {
        foreach (self::getPreload() as $p) {
            if ($p->key == $key) {
                return $p->value;
            }
        }

        return null;
    }
}
