<?php
namespace common\components;

use yii\helpers\ArrayHelper;

class Facebook {

    private $appId = '597412183700544';
    private $appSecret = 'ae62e4a11fbd879e9394ae8001088253';
    private $url = 'https://graph.facebook.com/';
    private $appToken;


    public function getEvent($events) {
        if (is_array($events)) {
            $events = implode(',', $events);
        }

        $url = $this->url . 'v2.8/?' .http_build_query([
                'ids' => $events,
                'fields' => 'attending_count',
                'access_token' => $this->getAppToken(),
            ]);
        return json_decode($this->sendRequest($url), true);
    }

    private function getAppToken() {
        return $this->appId . '|' . $this->appSecret;
    }

    public function sendRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec ($ch);
        curl_close ($ch);
        return $result;
    }
}