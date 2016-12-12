<?php

namespace product\models;

use Yii;

/**
 * This is the model class for table "product_attr_value".
 *
 * @property integer $id
 * @property string $label
 * @property integer $attr_id
 * @property integer $position
 *
 * @property ProductAttr $attr
 * @property ProductProductAttrValue[] $productProductAttrValues
 */
class ProductAttrValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_attr_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'attr_id'], 'required'],
            [['attr_id', 'position'], 'integer'],
            [['label'], 'string', 'max' => 255],
            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductAttr::className(), 'targetAttribute' => ['attr_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Значение',
            'attr_id' => 'Атрибут',
            'position' => 'Позиция',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttr()
    {
        return $this->hasOne(ProductAttr::className(), ['id' => 'attr_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductProductAttrValues()
    {
        return $this->hasMany(ProductProductAttrValue::className(), ['value_id' => 'id']);
    }
}
