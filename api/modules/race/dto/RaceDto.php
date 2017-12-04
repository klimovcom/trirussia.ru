<?php
namespace api\modules\race\dto;

use yii\base\Model;

class RaceDto extends Model
{
    public $id;
    public $start_date;
    public $promo;
    public $place;

    public $sport;

    public $organizer;
}