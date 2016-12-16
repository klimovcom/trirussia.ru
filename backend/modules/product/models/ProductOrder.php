<?php

namespace product\models;

use Yii;

/**
 * This is the model class for table "product_order".
 *
 * @property integer $id
 * @property string $label
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $date
 * @property integer $time
 * @property integer $cost
 * @property string $comment
 * @property integer $status
 *
 * @property ProductOrderProductOrderItem[] $productOrderProductOrderItems
 * @property ProductOrderItem[] $productOrderItems
 */
class ProductOrder extends \yii\db\ActiveRecord
{

    const TIME_MORNING = 1;
    const TIME_NOONDAY = 2;
    const TIME_EVENING = 3;

    const STATUS_CREATED = 0;
    const STATUS_PAID = 1;
    const STATUS_CLOSE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'name', 'email', 'phone', 'address', 'date', 'time', 'cost', 'status'], 'required'],
            [['time', 'cost', 'status'], 'integer'],
            [['comment'], 'string'],
            [['label', 'name', 'email', 'phone', 'address', 'date'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Заказ',
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'date' => 'Дата',
            'time' => 'Время',
            'cost' => 'Стоимость',
            'comment' => 'Комментарий',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOrderProductOrderItems()
    {
        return $this->hasMany(ProductOrderProductOrderItem::className(), ['product_order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOrderItems()
    {
        return $this->hasMany(ProductOrderItem::className(), ['id' => 'product_order_item_id'])->viaTable('product_order_product_order_item', ['product_order_id' => 'id']);
    }

    public static function getTimeArray() {
        return [
            self::TIME_MORNING => '9:00 — 13:00',
            self::TIME_NOONDAY => '14:00 — 18:00',
            self::TIME_EVENING => '19:00 — 21:00',
        ];
    }

    public static function getStatusArray() {
        return [
            self::STATUS_CREATED => 'Cоздан',
            self::STATUS_PAID => 'Оплачен',
            self::STATUS_CLOSE => 'Закрыт',
        ];
    }
}
