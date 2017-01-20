<?php
namespace common\components;

use yii\helpers\ArrayHelper;

class YandexTranslator {

    private $key = 'trnsl.1.1.20170120T124503Z.7b086902f22a0140.967b70898f2c90416c65b9d10e56194d64cb43d2';
    private $url = 'https://translate.yandex.net/api/v1.5/tr.json/translate';
    private $lang = 'ru-en';
    private $texts = [];

    public function __construct($texts) {
        $this->texts = $texts;
    }

    public function translate() {
        $url = $this->url .
            '?key=' . $this->key .
            '&lang=' . $this->lang;
        foreach ($this->texts as $text) {
            $url .= '&text=' . urlencode($text);
        }
        $translator = json_decode(file_get_contents($url), true);

        if (ArrayHelper::getValue($translator, 'code') != '200') {
            return false;
        }

        return ArrayHelper::getValue($translator, 'text');
    }
}