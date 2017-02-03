<?php

namespace promocode\models;

use Yii;


class PromocodeQuery extends \yii\db\ActiveQuery {

    public function published() {
        return $this->andWhere(['published' => true]);
    }

}
/**
 * This is the model class for table "promocode".
 *
 * @property integer $id
 * @property string $label
 * @property string $url
 * @property string $promo
 * @property integer $discount
 * @property string $conditions
 * @property string $promocode
 */
class Promocode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promocode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'url', 'discount', 'promocode'], 'required'],
            [['promo', 'conditions'], 'string'],
            [['discount', 'published'], 'integer'],
            [['label', 'url', 'promocode'], 'string', 'max' => 255],
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
            'url' => 'Сайт',
            'promo' => 'Промо',
            'discount' => 'Скидка',
            'conditions' => 'Условия',
            'promocode' => 'Промокод',
            'published' => 'Опубликовано',
        ];
    }

    public static function find() {
        return new PromocodeQuery(get_called_class());
    }
}
