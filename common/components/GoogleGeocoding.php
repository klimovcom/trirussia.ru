<?php
namespace common\components;

use yii\helpers\ArrayHelper;

class GoogleGeocoding {

    private $key = 'AIzaSyA_c5kL9gG1aeXBl4XDzyqAU3oH9jIUzKo';
    private $url = 'https://maps.googleapis.com/maps/api/geocode/json';
    private $address;

    public function __construct($address) {
        $this->address = $address;
    }

    public function locate() {
        $url = $this->url . '?address=' . urlencode($this->address ) . '&key=' . $this->key;
        $info = json_decode(file_get_contents($url), true);

        if (!$info) {
            return false;
        }

        if (ArrayHelper::getValue($info, 'status') != 'OK') {
            return false;
        }

        return [
            'lat' => ArrayHelper::getValue($info, 'results.0.geometry.location.lat'),
            'lng' => ArrayHelper::getValue($info, 'results.0.geometry.location.lng'),
        ];
    }
}