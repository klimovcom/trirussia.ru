<?php

namespace seo\models;

use configuration\models\Configuration;
use post\models\Post;
use yii\helpers\Url;
use Yii;
use yii\db\ActiveRecord;

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
            return $config;
        if (self::isRoute("site", "advertising") && $config = self::isRoute("site", "advertising"))
            return $config;
        if (self::isRoute("site", "domains") && $config = Configuration::get("seo_domains_page_$key"))
            return $config;
        if (self::isRoute("site", "bmi") && $config = Configuration::get("seo_bmi_page_$key"))
            return $config;
        if (self::isRoute("site", "convert") && $config = Configuration::get("seo_convert_page_$key"))
            return $config;

        if (self::isRoute("default", "view", "race") && $config = Configuration::get("seo_race_view_page_$key"))
            return $config;
        if (self::isRoute("site", "search-races") && $config = Configuration::get("seo_race_search_page_$key"))
            return $config;
        if (self::isRoute("site", "sport") && $config = Configuration::get("seo_race_sport_page_$key"))
            return $config;
        if (self::isRoute("site", "index") && $config = Configuration::get("seo_main_page_$key"))
            return $config;
        if (self::isRoute("default", "index", "post") && $config = Configuration::get("seo_magazine_page_$key"))
            return $config;
        if (self::isRoute("default", "view", "post") && $config = Configuration::get("seo_magazine_post_page_$key"))
            return $config;

        return Configuration::get("seo_standard_$key");
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
