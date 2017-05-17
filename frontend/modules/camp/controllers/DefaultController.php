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
    const PAGINATION_LIMIT = 30;

    public function actionIndex() {
        $models = Camp::find()->where(['>=', 'date_start', date('Y-m-d', time())])->orderBy(['date_start' => SORT_ASC])->published()->limit(self::PAGINATION_LIMIT)->all();
        $showMore = false;
        if (count($models) == self::PAGINATION_LIMIT) {
            $showMore = true;
        }
        return $this->render('index', [
            'models' => $models,
            'showMore' => $showMore,
        ]);
    }

    public function actionView($url) {
        $model = $this->findModel($url);
        $relatedModels = Camp::find()->where(['>=', 'date_start', date('Y-m-d', time())])->andWhere(['organizer_id' => $model->organizer_id])->andWhere(['not', ['id' => $model->id]])->published()->limit(4)->all();
        if (count($relatedModels) != 4) {
            $relatedModels = Camp::find()->where(['>=', 'date_start', date('Y-m-d', time())])->andWhere(['not', ['id' => $model->id]])->published()->limit(4)->all();
        }
        return $this->render('view', [
            'model' => $model,
            'relatedModels' => $relatedModels,
        ]);
    }

    public function actionGetMoreCamps() {
        $page = Yii::$app->request->post('page');
        $models = Camp::find()->where(['>=', 'date_start', date('Y-m-d', time())])
            ->orderBy(['date_start' => SORT_ASC])
            ->limit(self::PAGINATION_LIMIT)
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

    public function actionSearch() {

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
