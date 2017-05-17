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
    public function actionIndex() {
        $models = Camp::find()->where(['>=', 'date_start', date('Y-m-d', time())])->orderBy(['date_start' => SORT_ASC])->limit(30)->all();
        return $this->render('index', [
            'models' => $models,
        ]);
    }

    public function actionView($url) {
        $model = $this->findModel($url);

        return $this->render('view', [
            'model' => $model,
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
