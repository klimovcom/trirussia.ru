<?php

namespace willGo\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "will_go".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $race_id
 */
class WillGo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'will_go';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'race_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'race_id' => 'Race ID',
        ];
    }

    public static function isTakingPart($raceId){
        $model = self::find()->where(['race_id' =>$raceId, 'user_id'=>Yii::$app->user->identity->id])->one();
        if ($model)
            return true;
        return false;
    }

    public static function dismissUrl(){
        return Url::to('/willGo/default/remove-will-go');
    }

    public static function joinUrl(){
        return Url::to('/willGo/default/add-will-go');
    }
}
