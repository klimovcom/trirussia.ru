<?php
namespace common\components;

use yii\helpers\ArrayHelper;

class YandexSpeller {

    private $url = 'http://speller.yandex.net/services/spellservice.json/checkText';
    private $texts = [];

    public function __construct($texts) {
        $this->texts = $texts;
    }

    public function check() {
        $speller = $this->getSpeller();

        if (!$speller) {
            return false;
        }
        $this->updateText($speller);

        return $this->texts;
    }

    private function getSpeller() {
        $speller = [];
        foreach ($this->texts as $text) {
            $str = $text;
            $result = [];
            do {
                if (strlen($str) > 9500) {
                    $i = 9500;
                    while ($str[$i] != ' ') {
                        $i--;
                    }
                    $request = substr($str, 0, $i);
                    $str = substr($str, $i + 1);
                }else {
                    $request = $str;
                    $str = '';
                }

                $request = $this->sendRequest($request);
                if ($request === false) {
                    return false;
                }

                $result = ArrayHelper::merge($result, json_decode($request, true));
            }while (strlen($str));


            $speller[] = $result;
        }
        return $speller;
    }

    private function updateText($speller) {
        foreach ($speller as $key => $text) {
            foreach ($text as $error) {
                if (ArrayHelper::getValue($error['s'], 0)) {
                    $this->texts[$key] = str_replace($error['word'], ArrayHelper::getValue($error['s'], 0), $this->texts[$key]);
                }

            }
        }
    }

    public function sendRequest($text) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['text' => $text]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec ($ch);
        curl_close ($ch);
        return $result;
    }
}