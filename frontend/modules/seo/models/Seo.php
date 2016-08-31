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
        '{raceStartDate:dd.M.yyyy}' => 'dateRepresentation',
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
        if (self::isRoute("site", "index") && $config = Configuration::get("seo_main_page_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("default", "index", "post") && $config = Configuration::get("seo_magazine_page_$key"))
            return self::applyReplaces($config);
        if (self::isRoute("default", "view", "post") && $config = Configuration::get("seo_magazine_post_page_$key"))
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
            return '800';
        return '630';
    }

    public static function getPageTitleMeta()
    {
        return self::getMeta('title');
    }
}
