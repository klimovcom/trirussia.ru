<?php

namespace organizer\models;

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
 *
 * @property Race[] $races
 */

class OrganizerQuery extends \yii\db\ActiveQuery {

    public function published() {
        return $this->andWhere(['published' => 1]);
    }

}

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
            [['created', 'label', 'country', 'site', 'image_id', 'promo'], 'required'],
            [['created'], 'safe'],
            [['image_id', 'published'], 'integer'],
            [['promo', 'content'], 'string'],
            [['label', 'country', 'site', 'phone', 'email'], 'string', 'max' => 255],
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
        ];
    }

    public static function find() {
        return new OrganizerQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaces()
    {
        return $this->hasMany(Race::className(), ['organizer_id' => 'id']);
    }
}
