<?php

namespace product\models;

use Yii;

/**
 * This is the model class for table "product_order_item".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $info
 *
 * @property Product $product
 * @property ProductOrderProductOrderItem[] $productOrderProductOrderItems
 * @property ProductOrder[] $productOrders
 */
class ProductOrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_order_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id'], 'integer'],
            [['info'], 'string'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'info' => 'Info',
        ];
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
    public function getProductOrderProductOrderItems()
    {
        return $this->hasMany(ProductOrderProductOrderItem::className(), ['product_order_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOrders()
    {
        return $this->hasMany(ProductOrder::className(), ['id' => 'product_order_id'])->viaTable('product_order_product_order_item', ['product_order_item_id' => 'id']);
    }
}
