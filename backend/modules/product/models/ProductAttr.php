<?php

namespace product\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product_attr".
 *
 * @property integer $id
 * @property string $label
 * @property integer $type
 * @property integer $position
 *
 * @property ProductAttrValue[] $productAttrValues
 * @property ProductProductAttrValue[] $productProductAttrValues
 */
class ProductAttr extends \yii\db\ActiveRecord
{
    public $values = [];

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
            [['values'], 'safe'],
            [['label'], 'string', 'max' => 255],
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
            'category_id' => 'Категория',
            'type' => 'Тип',
            'position' => 'Позиция',
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
        return $this->hasMany(ProductAttrValue::className(), ['attr_id' => 'id'])->orderBy(['position' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductProductAttrValues()
    {
        return $this->hasMany(ProductProductAttrValue::className(), ['attr_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        $this->updateValues();
        return true;
    }

    public function updateValues() {
        $sortCounter = 0;
        $oldValues = ArrayHelper::getColumn($this->productAttrValues, 'id');
        $updatedValues = [];

        foreach ($this->values as $id => $value) {
            if (strpos($id, 'new') !== false) {
                $attrValue = new ProductAttrValue();
            }else {
                $attrValue = ProductAttrValue::find()->where(['id' => $id])->one();
                $updatedValues[] = $id;
            }
            $attrValue->attr_id = $this->id;
            $attrValue->position = $sortCounter;
            $attrValue->label = $value;
            $attrValue->save();

            $sortCounter++;
        }

        $attrToRemove = array_diff($oldValues, $updatedValues);
        if (count($attrToRemove)) {
            ProductAttrValue::deleteAll(['id' => $attrToRemove]);
        }
    }

    public static function getTypes() {
        return [
            self::TYPE_LIST => 'Список',
            self::TYPE_DROPDOWN => 'Выпадающее меню'
        ];
    }
}
