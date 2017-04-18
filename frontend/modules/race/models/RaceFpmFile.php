<?php

namespace race\models;

use metalguardian\fileProcessor\helpers\FPM;
use Yii;
use metalguardian\fileProcessor\models\File;

/**
 * This is the model class for table "race_fpm_file".
 *
 * @property integer $race_id
 * @property integer $fpm_file_id
 * @property integer $type
 *
 * @property File $file
 * @property Race $race
 */
class RaceFpmFile extends \yii\db\ActiveRecord
{
    const TYPE_REGULATION = 0;
    const TYPE_TRACE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'race_fpm_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['race_id', 'fpm_file_id'], 'required'],
            [['race_id', 'fpm_file_id', 'type'], 'integer'],
            [['fpm_file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['fpm_file_id' => 'id']],
            [['race_id'], 'exist', 'skipOnError' => true, 'targetClass' => Race::className(), 'targetAttribute' => ['race_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'race_id' => 'Race ID',
            'fpm_file_id' => 'Fpm File ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::className(), ['id' => 'fpm_file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }

    public function beforeDelete()
    {
        parent::beforeDelete();

        FPM::deleteFile($this->fpm_file_id);

        return true;
    }
}
