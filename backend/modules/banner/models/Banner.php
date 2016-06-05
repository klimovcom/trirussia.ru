<?php

namespace banner\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $label
 * @property integer $image_id
 * @property integer $status
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id', 'status'], 'integer'],
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
            'label' => 'Label',
            'image_id' => 'Image ID',
            'status' => 'Status',
        ];
    }
}
