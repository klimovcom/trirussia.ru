<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tristats_winners".
 *
 * @property integer $id
 * @property string $name
 * @property string $country
 * @property string $division
 * @property integer $division_rank
 * @property string $swim
 * @property string $run
 * @property string $bike
 * @property string $finish
 * @property integer $tristats_race_id
 *
 * @property TristatsRaces $tristatsRace
 */
class TristatsWinners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tristats_winners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['division_rank', 'tristats_race_id'], 'integer'],
            [['name', 'country', 'division', 'swim', 'run', 'bike', 'finish'], 'string', 'max' => 255],
            [['tristats_race_id'], 'exist', 'skipOnError' => true, 'targetClass' => TristatsRaces::className(), 'targetAttribute' => ['tristats_race_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'country' => 'Страна',
            'division' => 'Дивизион',
            'division_rank' => 'Позиция',
            'swim' => 'Плавание',
            'run' => 'Бег',
            'bike' => 'Вело',
            'finish' => 'Финиш',
            'tristats_race_id' => 'Tristats Race ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTristatsRace()
    {
        return $this->hasOne(TristatsRaces::className(), ['id' => 'tristats_race_id']);
    }
}
