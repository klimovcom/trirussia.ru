<?php

namespace product\models;

use Yii;

/**
 * This is the model class for table "product_order".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $date
 * @property integer $time
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

    public $is_new;

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
            [['name', 'email', 'phone', 'address', 'date', 'time', 'label'], 'required'],
            [['date', 'is_new'], 'safe'],
            [['time', 'status', 'cost'], 'integer'],
            [['name', 'email', 'phone', 'address', 'label'], 'string', 'max' => 255],
            [['comment'], 'string'],
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
            'name' => 'Как вас зовут?',
            'email' => 'Ваш email',
            'phone' => 'Ваш телефон',
            'address' => 'Адрес для доставки',
            'date' => 'Когда привезти?',
            'time' => 'Во сколько?',
            'comment' => 'Комментарий',
            'cost' => 'Стоимость',
        ];
    }

    public function __construct(array $config = [])
    {
        $this->date = date("Y-m-d", time() + 3 * 60 * 60 * 24);
        $this->label = ProductOrder::createUniqueLabel(4);
        return parent::__construct($config);
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if ($this->isNewRecord) {
            $this->is_new = true;
            $this->status = ProductOrder::STATUS_CREATED;
            $this->cost = Yii::$app->cart->getCost();
        }else {
            $this->is_new = false;
        }
        return true;
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        if ($this->is_new) {
            $values = [];
            $positions = Yii::$app->cart->getPositions();
            foreach ($positions as $position) {
                if ($position->getQuantity() > 0) {
                    $values[] = [$this->id, $position->id, $position->getQuantity()];
                }
            }
            self::getDb()->createCommand()->batchInsert('product_order_product_order_item', ['product_order_id', 'product_order_item_id', 'quantity'], $values)->execute();
            Yii::$app->cart->removeAll();
        }
        return true;
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

    public static function createUniqueLabel($length) {
        $chars = ['ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz', '1234567890'];
        do {
            $resultArr = [];
            foreach ($chars as $char) {
                $counter = $length;
                $temp = '';
                while ($counter-->0) {

                    $temp.= $char[mt_rand(0,strlen($char)-1)];
                }
                $resultArr[] = $temp;
            }
            $result = implode('-', $resultArr);
        }while (ProductOrder::find()->where(['label' => $result])->one());
        return $result;
    }

    public function getOrderPositionsString() {
        $result = '';
        foreach ($this->productOrderProductOrderItems as $orderItem) {
            $result .= $orderItem->productOrderItem->product->label .': ';
            foreach (unserialize($orderItem->productOrderItem->info) as $value) {
                $result .= $value['attr'] . ': ' . $value['value'] . ', ';
            }
            $result.= 'кол-во:' . $orderItem->quantity . '; ';
        }

        return $result;
    }
}
