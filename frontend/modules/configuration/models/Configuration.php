<?php

namespace configuration\models;

use Yii;
use yii\helpers\VarDumper;

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
    private static $_replaces = false;

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

    public static function getReplaces()
    {
        if (self::$_replaces === false ){
            self::$_replaces = self::filterReplaces();
        }
        return self::$_replaces;
    }

    public static function filterReplaces()
    {
        $result = [];
        foreach (self::getPreload() as $config) {
            if ($config->key[0] == '[' && substr($config->key, -1) == ']') {
                $result[$config->key] = $config->value;
            }
        }
        return $result;
    }

    public static function get($key)
    {
        foreach (self::getPreload() as $p) {
            if ($p->key == $key) {
                return self::applyReplaces($p->value);
            }
        }

        return null;
    }

    public static function applyReplaces($value)
    {
        foreach (self::getReplaces() as $replaceKey => $replaceValue){
            if (strpos($value, $replaceKey) !== false){
                $value = str_replace($replaceKey, $replaceValue, $value);
            }
        }
        return $value;
    }
}
