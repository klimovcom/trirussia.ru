<?php

namespace organizer\models;

use Yii;
use race\models\Race;

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

    public $race_count;

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

    public function getPublishedRaces()
    {
        return $this->hasMany(Race::className(), ['organizer_id' => 'id'])->where(['race.published' => 1]);
    }

    public function getNearlyRaces() {
        return $this->hasMany(Race::className(), ['organizer_id' => 'id'])->where(['>=','race.start_date', date('Y-m-d', time())])->andWhere(['race.published' => 1])->orderBy(['race.start_date' => SORT_ASC])->limit(3);
    }

    public function getNearlyPastRaces() {
        return $this->hasMany(Race::className(), ['organizer_id' => 'id'])->where(['<','race.start_date', date('Y-m-d', time())])->andWhere(['race.published' => 1])->orderBy(['race.start_date' => SORT_DESC])->limit(3);
    }
}
