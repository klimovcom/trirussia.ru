<?php

namespace organizer\models;

use metalguardian\fileProcessor\behaviors\UploadBehavior;
use metalguardian\fileProcessor\helpers\FPM;
use race\models\Race;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "organizer".
 *
 * @property integer $id
 * @property string $created
 * @property string $label
 * @property string $country
 * @property string $site
 * @property string $phone
 * @property string $email
 * @property integer $image_id
 * @property string $promo
 * @property string $content
 * @property integer $published
 */
class Organizer extends \yii\db\ActiveRecord
{
    public function __construct(array $config = [])
    {
        $this->created = date("Y-m-d H:i", time());
        return parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organizer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'label'], 'required'],
            [['created'], 'safe'],
            [['image_id',], 'safe'],
            [[/*'image_id', */
                'published'], 'integer'],
            [['promo', 'content'], 'string'],
            [['label', 'country', 'site', 'phone', 'email', 'api_key'], 'string', 'max' => 255]
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
            'country' => 'Страна',
            'site' => 'Сайт',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'image_id' => 'Изображение',
            'promo' => 'Промо',
            'content' => 'Содержание',
            'published' => 'Опубликовано',
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
                    'validator' => [
                        'extensions' => 'png, jpg, svg, tiff',
                    ],
                    'image' => true,
                    'required' => false,
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

        $alienModel = Organizer::find()->where(['label' => 'Другой'])->one();
        $alien = $alienModel->id;
        $races = Race::find()->where(['organizer_id'=> $this->id])->all();
        foreach($races as $race){
            $race->organizer_id = $alien;
            $race->save();
        }
        FPM::deleteFile($this->image_id);

        return true;
    }
}
