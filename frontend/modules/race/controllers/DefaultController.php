<?php

namespace race\controllers;

use distance\models\DistanceCategory;
use frontend\models\SearchRaceForm;
use frontend\widgets\searchRacesPanel\SearchRacesPanel;
use organizer\models\Organizer;
use race\models\Race;
use race\models\RaceDistanceCategoryRef;
use seo\models\Seo;
use sport\models\Sport;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `race` module
 */
class DefaultController extends Controller
{
    public function actionView($url){
        /** @var Race $race */
        $race = Race::find()->where(['url' => $url])->one();
        if (!$race){
            throw new NotFoundHttpException();
        }
        Seo::registerModel($race);
        $race->addStatisticsView();
        return $this->render('view', ['race' => $race, ]);
    }
    
    public function actionUpdateSearchDistance(){
        if (\Yii::$app->request->isAjax){
            $distanceCategories = DistanceCategory::find()
                ->where( !empty($_POST['sportId']) ? ['sport_id' => $_POST['sportId']] : [] )
                ->all();
            return $this->renderAjax('_options', ['options' => ArrayHelper::map($distanceCategories, 'id', 'label'), ]);
        } 
        throw new NotFoundHttpException();
    }
    
    public function actionUpdateUrl(){
        if (\Yii::$app->request->isAjax){
            if ($_POST['SearchRaceForm']){
                $data = [];
                foreach ($_POST['SearchRaceForm'] as $key => $value){
                    if ($value && $key != 'sport'){
                        $data[$key] = $value;
                    }
                }

                $sport = '';
                if (!empty($_POST['SearchRaceForm']['sport'])) {
                    $sport = Sport::findOne($_POST['SearchRaceForm']['sport']);
                    if (!$sport)
                        throw new NotFoundHttpException();
                    $sport = $sport->url;
                }

                if ($sport)
                    $url = '/' . $sport;
                else
                    $url = '/search-races';
                if (!empty($data))
                    $url .= '?' . http_build_query($data);
                return $this->renderAjax('_submit-url', ['url' => $url, ]);
            }
        }
        throw new NotFoundHttpException();
    }

    public function actionGetMoreRaces()
    {
        $this->layout = false;

        $page = $_POST['page'] + 2;
        if (!empty($_POST['renderType']) && $_POST['renderType'] == 'search' )
            $page = $_POST['page'];

        $raceCondition = Race::find();

        $sport = null;
        if (!empty($_POST['sport'])){
            $sport = $_POST['sport'];
        }

        if ($sport){
            $page = $_POST['page'];
            if ($sportModel = Sport::find()->where(['url' => $sport])->one()) {
                $raceCondition->andWhere(['sport_id'  => $sportModel->id ]);
            }
        }


        if (!empty($_POST['distance'])){
            $idArray = [];
            $distance = DistanceCategory::find()->where(['label' => $_POST['distance'], 'sport_id'  => $sport->id ])->one();
            if (!$distance){
                throw new NotFoundHttpException();
            }
            $refs = RaceDistanceCategoryRef::find()->where(['distance_category_id' => $distance->id, ])->all();
            foreach ($refs as  $ref)
                $idArray[] = $ref->race_id;
            if (!empty($idArray))
                $raceCondition->andWhere(['in', Race::tableName().'.id', $idArray]);
        }

        if (!empty($_POST['date'])){
            $raceCondition->andWhere(['between', 'start_date', $_POST['date'], substr($_POST['date'], 0, 8) . '31']);
        } else {
            $raceCondition->andWhere(['>=', 'start_date', date('Y-m-d', time())]);
        }

        if (!empty($_POST['country'])) $raceCondition->andWhere(['country' => $_POST['country']]);

        if (!empty($_POST['organizer'])){
            $raceCondition->leftJoin(Organizer::tableName(), 'organizer_id = organizer.id');
            $raceCondition->andWhere([Organizer::tableName().'.label' => $_POST['organizer']]);
        }

        if (!empty($_POST['sort']) && $_POST['sort'] == 'popular'){
            $races = $raceCondition->orderBy('popularity DESC, start_date ASC, id DESC')->limit(12)->offset($page*12)->all();
        } else {
            $races = $raceCondition->orderBy('start_date ASC, id DESC')->limit(12)->offset($page*12)->all();
        }



        if (!empty($_POST['renderType']) && $_POST['renderType'] == 'search' )
            return Json::encode([
                'result' => count($races),
                'data' => $this->render('_more-races-search', ['moreRaces' => $races]),
                'list' => $this->render('_more-races-search-list', ['moreRaces' => $races]),
            ]);

        return Json::encode([
            'result' => count($races),
            'data' => $this->render('_more-races', ['moreRaces' => $races]),
        ]);
    }
}
