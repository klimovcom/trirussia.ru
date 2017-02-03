<?php

namespace sport\models;

use Yii;
use yii\helpers\ArrayHelper;
use metalguardian\fileProcessor\behaviors\UploadBehavior;
use metalguardian\fileProcessor\helpers\FPM;

/**
 * This is the model class for table "sport".
 *
 * @property integer $id
 * @property string $label
 * @property string $url
 * @property boolean $is_on_main
 */
class Sport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'url', ], 'string', 'max' => 255],
            [['url',], 'unique'],
            [['is_on_main', ], 'integer'],
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
            'url' => 'Название в URL',
            'is_on_main' => 'На главной',
            'icon_id' => 'Иконка',
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
                'icon_id' => [
                    'class' => UploadBehavior::className(),
                    'attribute' => 'icon_id',
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

        FPM::deleteFile($this->icon_id);

        return true;
    }
}
