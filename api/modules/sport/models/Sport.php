<?php

namespace api\modules\sport\models;

use api\modules\race\models\Race;
use Yii;

/**
 * This is the model class for table "sport".
 *
 * @property integer $id
 * @property string $label
 * @property string $url
 * @property string $is_on_main
 * @property integer $icon_id
 *
 * @property Race[] $races
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
            [['icon_id'], 'integer'],
            [['label', 'url', 'is_on_main'], 'string', 'max' => 255],
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
            'url' => 'Url',
            'is_on_main' => 'Is On Main',
            'icon_id' => 'Icon ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaces()
    {
        return $this->hasMany(Race::className(), ['sport_id' => 'id']);
    }
}
