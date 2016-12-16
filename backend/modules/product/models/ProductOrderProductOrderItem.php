<?php

namespace product\models;

use Yii;

/**
 * This is the model class for table "product_order_product_order_item".
 *
 * @property integer $product_order_id
 * @property integer $product_order_item_id
 * @property integer $quantity
 *
 * @property ProductOrder $productOrder
 * @property ProductOrderItem $productOrderItem
 */
class ProductOrderProductOrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_order_product_order_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_order_id', 'product_order_item_id', 'quantity'], 'required'],
            [['product_order_id', 'product_order_item_id', 'quantity'], 'integer'],
            [['product_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductOrder::className(), 'targetAttribute' => ['product_order_id' => 'id']],
            [['product_order_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductOrderItem::className(), 'targetAttribute' => ['product_order_item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_order_id' => 'Product Order ID',
            'product_order_item_id' => 'Product Order Item ID',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOrder()
    {
        return $this->hasOne(ProductOrder::className(), ['id' => 'product_order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOrderItem()
    {
        return $this->hasOne(ProductOrderItem::className(), ['id' => 'product_order_item_id']);
    }
}
