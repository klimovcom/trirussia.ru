<?php

namespace seo\models;

use configuration\models\Configuration;
use post\models\Post;
use yii\helpers\Url;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "seo".
 *
 * @property integer $id
 * @property string $model_name
 * @property integer $model_id
 * @property string $title
 * @property string $keywords
 * @property string $description
 */
class Seo extends \yii\db\ActiveRecord
{
    private static $_model;

    public static $replaces = [
        '{raceLabel}' => 'label',
        '{raceStartDate}' => 'start_date',
        '{raceStartTime:hh:mm:ss}' => 'timeRepresentation',
        '{raceStartDate:dd.M.yyyy}' => 'dateRepresentation',
        '{raceDate:yyyy-mm-dd}' => 'dateRepresentationScript',
        '{raceCountry}' => 'country',
        '{raceRegion}' => 'region',
        '{racePlace}' => 'place',
        '{raceSportLabel}' => [
            'sport' => 'label'
        ],
        '{raceDistanceCategoryLabel}' => 'distanceCategory',
        '{raceOrganizerLabel}' => [
            'organizer' => 'label',
        ],
        '{racePromo}' => 'promo',
        '{raceStartTime}' => 'start_time',
        '{raceAddress}' => 'address',
        '{raceImageUrl}' => 'imageUrl',
        
        '{sportLabel}' => 'label',
        '{sportCondition}' => 'condition',
        '{sportLabel:дательный}' => 'labelModified',

        '{postTags}' => 'tags',
        '{postPromo}' => 'promo',
        '{postTitle}' => 'label',
        '{postImageUrl}' => 'imageUrl',
        '{postDate}' => 'created',
        '{postAuthor}' => [
            'author' => 'fullName'
        ],
        '{productTitle}' => 'label',
        '{productPromo}' => 'promo',

        '{tag}' => 'tags',
        '{label}' => 'label',
        '{imageUrl}' => 'imageUrl',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_name', 'model_id'], 'required'],
            [['model_id'], 'integer'],
            [['description'], 'string'],
            [['model_name', 'title', 'keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_name' => 'Model Name',
            'model_id' => 'Model ID',
            'title' => 'Title',
            'keywords' => 'Keywords',
            'description' => 'Description',
        ];
    }

    public static function registerModel(ActiveRecord $model)
    {
        self::$_model = $model;
    }

    public static function getModuleName()
    {
        return Yii::$app->controller->module->id;
    }
    
    public static function getControllerName()
    {
        return Yii::$app->controller->id;
    }

    public static function getActionName()
    {
        return Yii::$app->controller->action->id;
    }

    public static function isRoute($controller, $action, $module = 'app-frontend')
    {
        if (
            !$module &&
            $controller == self::getControllerName() &&
            $action == self::getActionName()
        )
            return true;
        if (
            $module == self::getModuleName() &&
            $controller == self::getControllerName() &&
            $action == self::getActionName()
        )
            return true;
        return false;
    }


    public static function getAuthorMeta()
    {
        if (self::isRoute('default', 'view', 'post') && self::$_model)
            return self::$_model->author->getFullName();
        return Configuration::get('seo_standard_author');
    }

    public static function getUrlMeta()
    {
        return Url::to(Yii::$app->request->url, true);
    }

    public static function getMeta($key)
    {
        if (self::$_model) {
            $seo = Seo::find()->where(['model_name' => self::getModelClass(self::$_model), 'model_id' => self::$_model->id])->one();
            if ($seo) {
                $result_string = '';
                if ($key == 'title') {
                    $result_string = $seo->title;
                }
                if ($key == 'keywords') {
                    $result_string = $seo->keywords;
                }
                if ($key == 'description') {
                    $result_string = $seo->description;
                }
                if ($key == 'og_image') {
                    $result_string = $seo->og_image_id ? Url::to(\metalguardian\fileProcessor\helpers\FPM::originalSrc($seo->og_image_id), true) : '';
                }
                if ($result_string) {
                    return $result_string;
                }
            }
        }

        //static pages
        if (self::isRoute("site", "about") && $config = Configuration::get("seo_about_page_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("site", "advertising") && $config = Configuration::get("seo_advertising_page_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("site", "domains") && $config = Configuration::get("seo_domains_page_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("site", "bmi") && $config = Configuration::get("seo_bmi_page_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("site", "convert") && $config = Configuration::get("seo_convert_page_$key"))
            return self::applyReplaces($config);


        if (self::isRoute("default", "view", "race") && $config = Configuration::get("seo_race_view_page_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("site", "search-races") && $config = Configuration::get("seo_race_search_page_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("site", "sport") && $config = Configuration::get("seo_race_sport_page_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("default", "create", "race") && $config = Configuration::get("seo_race_create_page_$key"))
            return self::applyReplaces($config);

        if (self::isRoute("site", "index") && $config = Configuration::get("seo_main_page_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("default", "index", "post") && $config = Configuration::get("seo_magazine_page_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("default", "view", "post") && $config = Configuration::get("seo_magazine_post_page_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("default", "search", "post") && $config = Configuration::get("seo_magazine_search_tag_page_$key"))
            return self::applyReplaces($config);

        //магазин
        if (self::isRoute("default", "index", "product") && $config = Configuration::get("seo_shop_page_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("default", "view", "product") && $config = Configuration::get("seo_shop_product_page_$key"))
            return self::applyReplaces($config);

        //промокоды
        if (self::isRoute("default", "index", "promocode") && $config = Configuration::get("seo_promocodes_$key"))
            return self::applyReplaces($config);

        //тренеры
        if (self::isRoute("default", "index", "coach") && $config = Configuration::get("seo_coach_index_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("default", "view", "coach") && $config = Configuration::get("seo_coach_view_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("default", "create", "coach") && $config = Configuration::get("seo_coach_create_$key"))
            return self::applyReplaces($config);

        //кэмпы
        if (self::isRoute("default", "index", "camp") && $config = Configuration::get("seo_camp_index_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("default", "view", "camp") && $config = Configuration::get("seo_camp_view_$key"))
            return self::applyReplaces($config);

        //продажа слотов
        if (self::isRoute("race-slot-sell", "index", "race") && $config = Configuration::get("seo_race_sell_slot_$key"))
            return self::applyReplaces($config);

        //тренировочные планы
        if (self::isRoute("default", "index", "training_plan") && $config = Configuration::get("seo_training_plan_index_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("default", "view", "training_plan") && $config = Configuration::get("seo_training_plan_view_$key"))
            return self::applyReplaces($config);

        //тренировки
        if (self::isRoute("default", "index", "training") && $config = Configuration::get("seo_training_index_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("default", "create", "training") && $config = Configuration::get("seo_training_create_$key"))
            return self::applyReplaces($config);

        return Configuration::get("seo_standard_$key");
    }

    public static function applyReplaces($value)
    {
        foreach (self::$replaces as $replaceKey => $replaceValue){
            if (mb_strpos($value, $replaceKey) !== false){
                if (is_array($replaceValue)){
                    foreach ($replaceValue as $relation => $attribute){
                        if (isset(self::$_model->{$relation}->{$attribute}))
                            $value = str_replace($replaceKey, self::$_model->{$relation}->{$attribute}, $value);
                    }
                } else {
                    if (isset(self::$_model->{$replaceValue}))
                        $value = str_replace($replaceKey, self::$_model->{$replaceValue}, $value);
                }
            }
        }
        return $value;
    }

    public static function getKeywordsMeta()
    {
        return self::getMeta('keywords');
    }

    public static function getDescriptionMeta()
    {
        return self::getMeta('description');
    }

    public static function getImageMeta()
    {
        return self::getMeta('og_image');
    }

    public static function getImageTypeMeta()
    {
        return 'image/png';
    }

    public static function getImageWidthMeta()
    {
        if (self::isRoute('default', 'view', 'race') || self::isRoute('default', 'view', 'post'))
            return '800';
        return '1200';
    }

    public static function getImageHeightMeta()
    {
        if (self::isRoute('default', 'view', 'race') || self::isRoute('default', 'view', 'post'))
            return '450';
        return '630';
    }

    public static function getPageTitleMeta()
    {
        return self::getMeta('title');
    }

    public static function getScript()
    {
        if (self::isRoute("default", "view", "race")){
            $script = '<script type="application/ld+json">
                    {
                        "@context": "http://schema.org/",
                        "@type": "SportsEvent",
                        "name": "{raceLabel}",
                        "startDate": "{raceDate:yyyy-mm-dd}T{raceStartTime:hh:mm:ss}+03:00",
                        "location": {
                        "@type": "StadiumOrArena",
                        "name": "{racePlace}",
                        "address": "{raceCountry}"
                        },
                        "offers": {
                        "@type": "Offer",
                        "category": "primary",
                        "url": "'. Url::to('race/' . self::$_model->url, true).'"
                        },
                        "description": "{racePromo}",
                        "endDate": "{raceDate:yyyy-mm-dd}T23:00:00",
                        "image": "{raceImageUrl}",
                        "url": "'. Url::to('race/' . self::$_model->url, true).'",
                        "performer": "{raceOrganizerLabel}"
                    }
                </script>';
            return self::applyReplaces($script);
        }
        return '';
    }

    private static function getModelClass($model) {
        return (new \ReflectionClass($model))->getShortName();
    }
}
