<?php

namespace product\models;

use Yii;

/**
 * This is the model class for table "product_attr".
 *
 * @property integer $id
 * @property string $label
 * @property integer $type
 * @property integer $position
 * @property integer $category_id
 *
 * @property ProductCategory $category
 * @property ProductAttrValue[] $productAttrValues
 * @property ProductProductAttrValue[] $productProductAttrValues
 */
class ProductAttr extends \yii\db\ActiveRecord
{

    const TYPE_LIST = 1;
    const TYPE_DROPDOWN = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_attr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'type', 'category_id'], 'required'],
            [['type', 'position', 'category_id'], 'integer'],
            [['label'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'type' => 'Type',
            'position' => 'Position',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttrValues()
    {
        return $this->hasMany(ProductAttrValue::className(), ['attr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductProductAttrValues()
    {
        return $this->hasMany(ProductProductAttrValue::className(), ['attr_id' => 'id']);
    }
}
