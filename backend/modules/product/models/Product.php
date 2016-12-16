<?php

namespace product\models;

use metalguardian\fileProcessor\behaviors\UploadBehavior;
use metalguardian\fileProcessor\helpers\FPM;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

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
 */
class Product extends \yii\db\ActiveRecord
{
    public $images =  [];

    public function __construct(array $config = [])
    {
        $this->created = date("Y-m-d H:i", time());
        $this->popularity = 0;
        return parent::__construct($config);
    }

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
            [['created', 'images'], 'safe'],
            [['promo', 'content'], 'string'],
            [['price', 'published'], 'integer'],
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
            'created' => 'Дата создания',
            'label' => 'Название',
            'url' => 'URL',
            'promo' => 'Промо',
            'content' => 'Содержание',
            'images' => 'Изображения',
            'published' => 'Опубликовано',
            'popularity' => 'Популярность',
            'category_id' => 'Категория',
            'price' => 'Цена',
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        parent::beforeDelete();

        foreach ($this->productImages as $img) {
            $img->delete();
        }

        return true;
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

    public function getCategoriesArray() {
        return ;
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        $this->updateAttrValues();
        $this->uploadImages();

        return true;
    }

    public function updateAttrValues() {
        ProductProductAttrValue::deleteAll(['product_id' => $this->id]);
        $attrs = Yii::$app->request->post('Attr');
        if (!is_array($attrs)) {
            return false;
        }
        $valuesArray = [];

        foreach ($attrs as $attr => $values) {
            foreach ($values as $value) {
                $valuesArray[] = [$this->id, $attr, $value];
            }
        }
        self::getDb()->createCommand()->batchInsert(ProductProductAttrValue::tableName(), ['product_id', 'attr_id', 'value_id'], $valuesArray)->execute();
        return true;
    }

    public function uploadImages() {
        $this->images = UploadedFile::getInstances($this, 'images');

        foreach ($this->images as $image) {
            $model = new ProductImage();
            $model->product_id = $this->id;
            $model->image_id = FPM::transfer()->saveUploadedFile($image);
            $model->save();
        }
    }
}
