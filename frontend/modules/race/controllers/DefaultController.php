<?php

namespace race\controllers;

use distance\models\DistanceCategory;
use frontend\models\SearchRaceForm;
use frontend\widgets\searchRacesPanel\SearchRacesPanel;
use race\models\Race;
use race\models\RaceDistanceCategoryRef;
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
        $race->addStatisticsView();
        return $this->render('view', ['race' => $race, ]);
    }
    
    public function actionUpdateSearchDistance(){
        if (\Yii::$app->request->isAjax && !empty($_POST['sportId'])){
            $distanceCategories = DistanceCategory::find()->where(['sport_id' => $_POST['sportId']])->all();
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

                $url = '/' . $sport;
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

        $raceCondition = Race::find();

        $sportModel = $sport = null;
        if (!empty($_GET['sport'])){
            $sport = $_GET['sport'];
        }

        if ($sport){
            $page = $_POST['page'];
            if ($sportModel = Sport::find()->where(['url' => $sport])->one()) {
                $raceCondition->andWhere(['sport_id'  => $sportModel->id ]);
            } else {
                throw new NotFoundHttpException();
            }
        }


        if (!empty($_GET['distance'])){
            $idArray = [];
            $distance = DistanceCategory::find()->where(['label' => $_GET['distance'], 'sport_id'  => $sport->id ])->one();
            if (!$distance){
                throw new NotFoundHttpException();
            }
            $refs = RaceDistanceCategoryRef::find()->where(['distance_category_id' => $distance->id, ])->all();
            foreach ($refs as  $ref)
                $idArray[] = $ref->race_id;
            if (!empty($idArray))
                $raceCondition->andWhere(['in', 'id', $idArray]);
        }

        if (!empty($_GET['date'])){
            $raceCondition->andWhere(['between', 'start_date', $_GET['date'], substr($_GET['date'], 0, 8) . '31']);
        } else {
            $raceCondition->andWhere(['>=', 'start_date', date('Y-m-d', time())]);
        }

        if (!empty($_GET['country'])) $raceCondition->andWhere(['country' => $_GET['country']]);

        if (!empty($_GET['organizer'])){
            $raceCondition->leftJoin('{{%organizer}}', 'organizer_id = organizer.id');
            $raceCondition->andWhere(['organizer.label' => $_GET['organizer']]);
        }

        $races = $raceCondition->orderBy('start_date ASC, id DESC')->limit(12)->offset($page*12)->all();

        return Json::encode([
            'result' => count($races),
            'data' => $this->render('_more-races', ['moreRaces' => $races]),
        ]);
    }
}
