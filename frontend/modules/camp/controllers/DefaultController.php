<?php

namespace camp\controllers;

use camp\models\Camp;
use common\components\CountryList;
use common\models\UserInfo;
use race\models\RaceRating;
use race\models\RaceRegistration;
use Yii;
use distance\models\Distance;
use distance\models\DistanceCategory;
use distance\models\DistanceDistanceCategoryRef;
use frontend\models\SearchRaceForm;
use frontend\widgets\searchRacesPanel\SearchRacesPanel;
use organizer\models\Organizer;
use race\models\Race;
use race\models\RaceDistanceCategoryRef;
use seo\models\Seo;
use sport\models\Sport;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `camp` module
 */
class DefaultController extends Controller
{
    const PAGINATION_LIMIT = 30;

    public function actionIndex($organizer = null, $country = null) {
        $campQuery = Camp::find()->where(['>=', 'date_start', date('Y-m-d', time())]);

        if ($organizer) {
            $organizerModel = Organizer::find()->where(['label' => $organizer])->published()->one();

            if ($organizerModel) {
                $campQuery->andWhere(['organizer_id' => $organizerModel->id]);
            }

            $organizer = $organizerModel;
        }

        if ($country) {
            $campQuery->andWhere(['country' => $country]);
        }

        $campQuery->published()->orderBy(['date_start' => SORT_ASC])->limit(self::PAGINATION_LIMIT);
        $models = $campQuery->all();

        $showMore = false;
        if (count($models) == self::PAGINATION_LIMIT) {
            $showMore = true;
        }

        if (Yii::$app->cache->exists('camp_countries')) {
            $countries = Yii::$app->cache->get('camp_countries');
        }else {
            $countries = (new Query())->
            select(['country', 'COUNT(country) as country_count', 'date_start'])
                ->from(Camp::tableName())
                ->where(['published' => 1])
                ->andWhere(['>=', 'date_start', date('Y-m-d', time())])
                ->groupBy(['country'])
                ->orderBy(['country_count' => SORT_DESC])
                ->limit(10)
                ->all();
            Yii::$app->cache->set('camp_countries', $countries, 60 * 60);
        }

        if (Yii::$app->cache->exists('camp_organizers')) {
            $organizers = Yii::$app->cache->get('camp_organizers');
        }else {
            $organizers = (new Query())->
            select(['organizer_id', 'COUNT(organizer_id) as organizers_count', Organizer::tableName() .'.label', Camp::tableName() . '.date_start'])
                ->from(Organizer::tableName())
                ->leftJoin(Camp::tableName(), Organizer::tableName() . '.id =' . Camp::tableName() . '.organizer_id')
                ->where([Camp::tableName() . '.published' => 1])
                ->andWhere(['>=', Camp::tableName() . '.date_start', date('Y-m-d', time())])
                ->groupBy(['organizer_id'])
                ->orderBy(['organizers_count' => SORT_DESC])
                ->limit(10)
                ->all();
            Yii::$app->cache->set('camp_organizers', $organizers, 60 * 60);
        }

        return $this->render('index', [
            'models' => $models,
            'showMore' => $showMore,
            'organizer' => $organizer,
            'country' => $country,
            'countries' => $countries,
            'organizers' => $organizers,
        ]);
    }

    public function actionView($url) {
        $model = $this->findModel($url);
        $relatedModels = Camp::find()->where(['>=', 'date_start', date('Y-m-d', time())])->andWhere(['organizer_id' => $model->organizer_id])->andWhere(['not', ['id' => $model->id]])->published()->limit(4)->all();
        if (count($relatedModels) != 4) {
            $relatedModels = Camp::find()->where(['>=', 'date_start', date('Y-m-d', time())])->andWhere(['not', ['id' => $model->id]])->published()->limit(4)->all();
        }

        Seo::registerModel($model);

        return $this->render('view', [
            'model' => $model,
            'relatedModels' => $relatedModels,
        ]);
    }

    public function actionGetMoreCamps() {
        $page = Yii::$app->request->post('page');
        $organizer = Yii::$app->request->post('organizer');
        $country = Yii::$app->request->post('country');

        $query = Camp::find()->where(['>=', 'date_start', date('Y-m-d', time())])
            ->orderBy(['date_start' => SORT_ASC]);
        if ($organizer) {
            $query->andWhere(['organizer_id' => $organizer]);
        }

        if ($country) {
            $query->andWhere(['country' => $country]);
        }

        $models = $query->limit(self::PAGINATION_LIMIT)
            ->offset(self::PAGINATION_LIMIT * $page)
            ->all();

        $result = '';
        foreach ($models as $model) {
            $result .= $this->renderPartial('card', [
                'model' => $model,
            ]);
        }
        return Json::encode([
            'result' => count($models),
            'data' => $result,
        ]);
    }

    public function findModel($url) {
        $model = Camp::find()->where(['url' => $url])->published()->one();
        if ($model !== null) {
            return $model;
        }else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
