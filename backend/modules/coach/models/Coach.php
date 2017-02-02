<?php

namespace coach\models;

use metalguardian\fileProcessor\behaviors\UploadBehavior;
use metalguardian\fileProcessor\helpers\FPM;
use sport\models\Sport;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "coach".
 *
 * @property integer $id
 * @property string $created
 * @property string $label
 * @property integer $image_id
 * @property string $country
 * @property string $site
 * @property string $phone
 * @property string $email
 * @property string $fb_link
 * @property string $vk_link
 * @property string $ig_link
 * @property string $promo
 * @property string $content
 */
class Coach extends \yii\db\ActiveRecord
{
    protected $specializationArray;
    public $coachSportRefs;

    public function getCoachSportRefs()
    {
        if (!$this->coachSportRefs)
            $this->coachSportRefs = CoachSportRef::findAll(['coach_id' => $this->id]);
        return $this->coachSportRefs;
    }

    public function getSpecializationArrayValues()
    {
        $sports = \yii\helpers\ArrayHelper::map(\sport\models\Sport::find()->all(), 'id', 'label');
        $refs = $this->getCoachSportRefs();
        $values = [];
        foreach($refs as $ref){
            $values[$ref->sport_id] = $sports[$ref->sport_id];
        }
        return $values;
    }

    public function getSpecializationArray()
    {
        if ($this->specializationArray === null){
            $this->specializationArray = [];
            $refs = $this->getCoachSportRefs();
            foreach($refs as $ref){
                $this->specializationArray[] = $ref->sport_id;
            }
        }
        return is_array($this->specializationArray) ? $this->specializationArray : [];
    }

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
        return 'coach';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'label', 'country'], 'required'],
            [['created', 'specializationArray', ], 'safe'],
            [['price'], 'integer'],
            [['label', 'country', 'site', 'phone', 'email', 'fb_link', 'vk_link', 'ig_link'], 'string', 'max' => 255]
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
            'label' => 'Имя',
            'image_id' => 'Изображение',
            'country' => 'Страна',
            'site' => 'Сайт',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'content' => 'Описание',
            'promo' => 'Промо',
            'fb_link' => 'Ссылка facebook',
            'vk_link' => 'Ссылка vkontakte',
            'ig_link' => 'Ссылка instagram',
            'specializationArray' => 'Cпециализации',
            'price' => 'Стоимость',
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

    public function beforeDelete()
    {
        parent::beforeDelete();
        $refs = $this->getCoachSportRefs();
        foreach($refs as $ref){
            $ref->delete();
        }
        FPM::deleteFile($this->image_id);
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $refs = $this->getCoachSportRefs();
        foreach($refs as $ref){
            $ref->delete();
        }
        if (is_array($this->specializationArray)){
            foreach($this->specializationArray as $sportId){
                $newRef = new CoachSportRef();
                $newRef->sport_id = $sportId;
                $newRef->coach_id = $this->id;
                $newRef->save();
            }
        }
        return parent::afterSave($insert, $changedAttributes);
    }
}
