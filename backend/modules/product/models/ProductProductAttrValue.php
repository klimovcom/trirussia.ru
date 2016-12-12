<?php

namespace product\models;

use Yii;

/**
 * This is the model class for table "product_product_attr_value".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $attr_id
 * @property integer $value_id
 *
 * @property ProductAttr $attr
 * @property Product $product
 * @property ProductAttrValue $value
 */
class ProductProductAttrValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_product_attr_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'attr_id', 'value_id'], 'required'],
            [['product_id', 'attr_id', 'value_id'], 'integer'],
            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductAttr::className(), 'targetAttribute' => ['attr_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['value_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductAttrValue::className(), 'targetAttribute' => ['value_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Продукт',
            'attr_id' => 'Атрибут',
            'value_id' => 'Значение',
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
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValue()
    {
        return $this->hasOne(ProductAttrValue::className(), ['id' => 'value_id']);
    }
}
