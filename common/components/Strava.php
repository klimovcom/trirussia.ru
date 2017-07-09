<?php
namespace common\components;

use Yii;
use yii\helpers\ArrayHelper;

class Strava {

    public function __construct() {
    }

    public function getSegmentExplorer($swLat, $swLng, $neLat, $neLng) {
        $url = 'https://www.strava.com/api/v3/segments/explore';
        $result = false;

        $response = $this->sendRequest($url . '?' . http_build_query([
                'bounds' => $swLat . ',' . $swLng . ',' . $neLat . ',' . $neLng,
            ])
        );

        if ($response) {
            $response = json_decode($response, true);
            $segmentArray = ArrayHelper::getValue($response, 'segments');

            $result = [];

            foreach ($segmentArray as $segment) {
                $result[] = [
                    'name' => ArrayHelper::getValue($segment, 'name'),
                    'lat' => ArrayHelper::getValue($segment, 'start_latlng.0'),
                    'lng' => ArrayHelper::getValue($segment, 'start_latlng.1'),
                    'distance' => ArrayHelper::getValue($segment, 'distance'),
                ];
            }
        }
        return $result;
    }

    public function sendRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . Yii::$app->params['stravaToken'],
        ]);
        $result = curl_exec ($ch);
        curl_close ($ch);
        return $result;
    }
}