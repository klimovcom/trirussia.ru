<?php
namespace common\components;

use yii\helpers\ArrayHelper;

class Tristats {

    public function __construct() {
    }

    public function getRacesByYear($year) {
        $responce = $this->sendRequest('http://tristats.ru/api/race/' . (int) $year);
        return json_decode($responce);
    }

    public function getRace($url) {
        $responce = $this->sendRequest('http://tristats.ru/api/race' . $url);
        return json_decode($responce);
    }

    public function getDivision($url) {
        $responce = $this->sendRequest('http://tristats.ru/api/division' . $url);
        return json_decode($responce);
    }
    public function sendRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec ($ch);
        curl_close ($ch);
        return $result;
    }
}