<?php

namespace post\models;

use metalguardian\fileProcessor\behaviors\UploadBehavior;
use metalguardian\fileProcessor\helpers\FPM;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $created
 * @property integer $author_id
 * @property string $label
 * @property string $url
 * @property string $promo
 * @property string $content
 * @property integer $image_id
 * @property integer $published
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'author_id', 'label', 'url', 'promo', 'content', 'image_id'], 'required'],
            [['created'], 'safe'],
            [['author_id', /*'image_id',*/ 'published'], 'integer'],
            [['promo', 'content'], 'string'],
            [['label', 'url'], 'string', 'max' => 255],
            [['url'], 'unique']
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
            'author_id' => 'Author ID',
            'label' => 'Label',
            'url' => 'Url',
            'promo' => 'Promo',
            'content' => 'Content',
            'image_id' => 'Image ID',
            'published' => 'Published',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'image_id' => [
                    'class' => UploadBehavior::className(),
                    'attribute' => 'image_id',
                    'image' => true,
                    'required' => true,
                ],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        parent::beforeDelete();

        FPM::deleteFile($this->image_id);

        return true;
    }
}
