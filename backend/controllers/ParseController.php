<?php
namespace backend\controllers;

use common\components\GoogleGeocoding;
use common\components\YandexTranslator;
use distance\models\Distance;
use distance\models\DistanceCategory;
use metalguardian\fileProcessor\models\File;
use organizer\models\Organizer;
use race\models\Race;
use race\models\RaceDistanceCategoryRef;
use race\models\RaceDistanceRef;
use sport\models\Sport;
use Yii;
use yii\web\Controller;
use metalguardian\fileProcessor\helpers\FPM;
use phpQuery;

/**
 * Site controller
 */
class ParseController extends Controller {

    public function actionIndex() {
        set_time_limit(0);

        //json with all needed races;
        $url = 'http://eu.ironman.com/handlers/searchraces.aspx?s=all%20events&d=27e93193-000b-434d-a2b8-8bb226043d4c|b5bb2639-fa51-4eb7-aaca-3cc65d72fdc3|&rs=&t=&l=undefined&m=';

        $data = json_decode($this->sendRequest($url), true)['body']['update']['html'][8];
        if ($data['id'] != 'filterBody') {
            return 'не тот ид';
        }
        $html = $data['value'];

        $organizer = Organizer::find()->where(['label' => 'Ironman'])->one();
        $sport = Sport::find()->where(['label' => 'Триатлон'])->one();

        $pq = \phpQuery::newDocument($html);

        $items = $pq->find('article');
        foreach ($items as $item) {
            $pqItem = pq($item);
            $a = $pqItem->find('header:first a:first');
            $name = $a->find('h2:first')->text();
            $link = $a->attr('href');
            $pos = $pqItem->find('header:first span:first')->text();
            echo $name . '<br>';
            $this->createProduct($link, $name, $pos, $organizer, $sport);
        }

    }

    public function createProduct($link, $name, $position, $organizer, $sport) {
        $page = \phpQuery::newDocument($this->sendRequest($link));

        $race = new Race();
        $race->label = $race->label_en = substr($name, 0, strlen($name)-2);

        $details = $page->find('#eventDetails');

        $race->start_date = $this->parseDate($details->find('.eventDate:first')->html());

        $race->url = strtolower(str_replace(' ', '-', $race->label)). '-' . Yii::$app->formatter->asDate($race->start_date, 'yyyy');

        $race->promo_en = $details->find('.eventDescription:first')->text();

        $content = $page->find('#mainContentCol4 section:first');
        $content->find('.breadcrumbs')->remove();
        $content->find('script')->remove();
        $content->find('noscript')->remove();

        $race->content_en = $this->clearContent($content->html());

        $positionArr = explode(',', $position);
        if (count($positionArr) === 3){
            $race->place = $race->place_en = trim($positionArr[0]);
            $race->region = $race->region_en = trim($positionArr[1]);
            $race->country = $race->country_en = trim($positionArr[2]);
        }elseif (count($positionArr) === 2) {
            $race->region = $race->region_en = trim($positionArr[0]);
            $race->country = $race->country_en = trim($positionArr[1]);
        }

        $coords = (new GoogleGeocoding($position))->locate();
        $race->coord_lat = $coords['lat'];
        $race->coord_lon = $coords['lng'];

        $image = $this->createImage($page->find('.slideImage:first img')->attr('src'));

        $race->main_image_id = $image->id;

        $translator = (new YandexTranslator([
            $race->promo_en,
            $race->content_en,
        ], 'en-ru', 'html'))->translate();

        $race->promo = $translator[0];
        $race->content = $translator[1];

        $race->site = $link;
        $race->organizer_id = $organizer->id;
        $race->display_type = Race::DISPLAY_TYPE_HIDE_IMAGE;
        $race->published = 0;
        $race->sport_id = $sport->id;
        $race->start_time = '13:30';
        $race->save(false);
        $this->createRace2Distances($race);
    }

    public function createImage($src) {
        $neededSrc = substr($src, 0, strrpos($src, '?'));
        $file = new File();
        $file->extension = substr($neededSrc, strrpos($neededSrc, '.') + 1);
        $file->base_name = str_replace('%20', '-', substr(substr($neededSrc, 0, strrpos($neededSrc, '.')), strrpos($neededSrc, '/') + 1));
        $file->save();

        $filename = FPM::getOriginalFileName($file->id, $file->base_name, $file->extension);
        $path = FPM::getOriginalDirectory($file->id) . DIRECTORY_SEPARATOR . $filename;

        $this->save_image($neededSrc . '?w=800&h=450&c=1', $path);
        return $file;
    }

    public function createRace2Distances($race) {
        if (strpos($race->label, '70.3') !== false) {
            $distanceCategory = DistanceCategory::find()->where(['label' => 'Half-Ironman'])->one();
            $distance = Distance::find()->where(['label' => 'Half-Ironman'])->one();
        }else {
            $distanceCategory = DistanceCategory::find()->where(['label' => 'Ironman'])->one();
            $distance = Distance::find()->where(['label' => 'Ironman'])->one();
        }

        if ($distance && $distanceCategory) {
            $raceDistanceCategory = new RaceDistanceCategoryRef();
            $raceDistanceCategory->distance_category_id = $distanceCategory->id;
            $raceDistanceCategory->race_id = $race->id;
            $raceDistanceCategory->save();

            $raceDistance = new RaceDistanceRef();
            $raceDistance->distance_id = $distance->id;
            $raceDistance->race_id = $race->id;
            $raceDistance->save();
        }
    }

    public function clearContent($content) {
        $content = strip_tags($content, '<p><h1><h2><h3><h4><h5><h6>');
        $content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $content);
        $content = preg_replace('/<p[^>]*><\\/p[^>]*>/', '', $content);

        if (strpos($content, '<h2>Latest News') !== false) {
            $content = substr($content, 0, strpos($content, '<h2>Latest News'));
        }
        return $content;
    }

    public function parseDate($dateHtml) {
        $dateText = str_replace('<br>',' ', $dateHtml);

        if (strpos($dateText, 'TBD') === false) {
            return Yii::$app->formatter->asDate(strtotime($dateText), 'yyyy-MM-dd');
        }else {
            $dateText = trim(str_replace('TBD', '', $dateText));
            return $dateText;
        }


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

    public function save_image($img,$path){
        $kurl = curl_init($img);
        curl_setopt($kurl, CURLOPT_HEADER, 0);
        curl_setopt($kurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($kurl, CURLOPT_BINARYTRANSFER,1);
        curl_setopt($kurl, CURLOPT_SSL_VERIFYPEER, false);
        $rawdata = curl_exec($kurl);
        curl_close($kurl);
        $fp = fopen($path,'w');
        fwrite($fp, $rawdata);
        fclose($fp);
    }
}