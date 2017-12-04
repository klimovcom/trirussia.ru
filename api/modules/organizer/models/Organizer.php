<?php

namespace api\modules\organizer\models;

use api\modules\race\models\Race;
use Yii;

/**
 * This is the model class for table "organizer".
 *
 * @property integer $id
 * @property string $created
 * @property string $label
 * @property string $country
 * @property string $site
 * @property string $phone
 * @property string $email
 * @property integer $image_id
 * @property string $promo
 * @property string $content
 * @property integer $published
 * @property string $api_key
 *
 * @property Race[] $races
 */
class Organizer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organizer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'label'], 'required'],
            [['created'], 'safe'],
            [['image_id', 'published'], 'integer'],
            [['promo', 'content'], 'string'],
            [['label', 'country', 'site', 'phone', 'email', 'api_key'], 'string', 'max' => 255],
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
            'country' => 'Country',
            'site' => 'Site',
            'phone' => 'Phone',
            'email' => 'Email',
            'image_id' => 'Image ID',
            'promo' => 'Promo',
            'content' => 'Content',
            'published' => 'Published',
            'api_key' => 'Api Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaces()
    {
        return $this->hasMany(Race::className(), ['organizer_id' => 'id']);
    }
}
