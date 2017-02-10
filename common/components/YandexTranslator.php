<?php
namespace common\components;

use yii\helpers\ArrayHelper;

class YandexTranslator {

    private $key = 'trnsl.1.1.20170210T153909Z.b64b89f64f77f9ec.4f96b0f39a6d08118f547dc662c49c511e62c55e';
    private $url = 'https://translate.yandex.net/api/v1.5/tr.json/translate';
    private $lang = 'ru-en';
    private $format = 'plain';
    private $texts = [];

    public function __construct($texts, $lang = null, $format = null) {
        $this->texts = $texts;
        if ($lang) {
            $this->lang = $lang;
        }
        if ($format) {
            $this->format = $format;
        }
    }

    public function translate() {
        $translator = [];
        foreach ($this->texts as $text) {
            $str = $text;
            $result = '';
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

                $translated = json_decode($request, true);

                if (ArrayHelper::getValue($translated, 'code') != '200') {
                    return false;
                }
                $result .= ArrayHelper::getValue($translated, 'text.0');

            }while (strlen($str));
            $translator[] = $result;
        }


        return $translator;
    }

    public function sendRequest($text) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['key' => $this->key, 'lang' => $this->lang, 'format' => $this->format, 'text' => $text]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec ($ch);
        return $result;
    }
}