<?php
namespace common\components;

use yii\base\Exception;
use yii\helpers\ArrayHelper;

class YandexSpeller {

    private $url = 'http://speller.yandex.net/services/spellservice.json/checkTexts';
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
        $url = $this->url . '?';
        foreach ($this->texts as $text) {
            $url .= 'text=' . urlencode($text) . '&';
        }
        $url = substr($url, 0, -1);

        return json_decode(file_get_contents($url), true);
    }

    private function updateText($speller) {
        foreach ($speller as $key => $text) {
            foreach ($text as $error) {
                $this->texts[$key] = str_replace($error['word'], $error['s'][0], $this->texts[$key]);
            }
        }
    }
}