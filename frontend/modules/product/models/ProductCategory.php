<?php

namespace product\models;

use Yii;

class ProductCategoryQuery extends \yii\db\ActiveQuery {

    public function published() {
        return $this->andWhere(['published' => true]);
    }

}

/**
 * This is the model class for table "product_category".
 *
 * @property integer $id
 * @property string $created
 * @property string $label
 * @property string $url
 * @property string $promo
 * @property string $content
 * @property integer $image_id
 * @property integer $published
 *
 * @property Product[] $products
 * @property ProductAttr[] $productAttrs
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'label', 'url'], 'required'],
            [['created'], 'safe'],
            [['promo', 'content'], 'string'],
            [['image_id', 'published'], 'integer'],
            [['label', 'url'], 'string', 'max' => 255],
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
            'url' => 'Url',
            'promo' => 'Promo',
            'content' => 'Content',
            'image_id' => 'Image ID',
            'published' => 'Published',
        ];
    }

    public static function find() {
        return new ProductCategoryQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttrs()
    {
        return $this->hasMany(ProductAttr::className(), ['category_id' => 'id']);
    }
}
