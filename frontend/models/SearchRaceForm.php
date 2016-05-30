<?php

namespace frontend\models;

use sport\models\Sport;
use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;

/**
 * Class SearchRaceForm
 * @package frontend\models
 */
class SearchRaceForm extends Model
{
    public $date;
    public $sport;
    public $distance;
    public $country;
    public $organizer;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        ];
    }
}
