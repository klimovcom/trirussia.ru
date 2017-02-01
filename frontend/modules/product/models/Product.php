<?php

namespace product\models;

use Yii;
use yii\helpers\Url;


class ProductQuery extends \yii\db\ActiveQuery {

    public function published() {
        return $this->andWhere(['published' => true]);
    }

}

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $created
 * @property string $label
 * @property string $url
 * @property string $promo
 * @property string $content
 * @property integer $image_id
 * @property integer $published
 * @property integer $popularity
 * @property integer $category_id
 * @property integer $price
 *
 * @property ProductCategory $category
 * @property ProductProductAttrValue[] $productProductAttrValues
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'label', 'url', 'category_id', 'price'], 'required'],
            [['created'], 'safe'],
            [['promo', 'content'], 'string'],
            [['image_id', 'published', 'popularity', 'category_id', 'price'], 'integer'],
            [['label', 'url'], 'string', 'max' => 255],
            [['url'], 'unique'],
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
            'created' => 'Created',
            'label' => 'Label',
            'url' => 'Url',
            'promo' => 'Promo',
            'content' => 'Content',
            'image_id' => 'Image ID',
            'published' => 'Published',
            'popularity' => 'Popularity',
            'category_id' => 'Category ID',
            'price' => 'Price',
        ];
    }

    public static function find() {
        return new ProductQuery(get_called_class());
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
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductProductAttrValues()
    {
        return $this->hasMany(ProductProductAttrValue::className(), ['product_id' => 'id']);
    }

    public function addStatisticsView() {
        $this->updateCounters(['popularity' => 1]);
    }

    public function getViewUrl() {
        return Url::to(['/product/default/view', 'url' => $this->url]);
    }
}
