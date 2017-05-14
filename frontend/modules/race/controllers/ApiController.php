<?php

namespace race\controllers;

use organizer\models\Organizer;
use race\models\Race;
use race\models\RaceDistanceRef;
use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ApiController extends Controller {

    public function beforeAction($event) {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return parent::beforeAction($event);
    }

    public function actionIndex() {
        $organizer = $this->auth();

        $races = Race::find()->where(['organizer_id' => $organizer->id, 'with_registration' => true])->all();

        $result = [];
        foreach ($races as $race) {
            $raceDistances = $race->raceDistanceRefs;

            $distances = [];
            foreach ($raceDistances as $raceDistance) {
                $distances[] = [
                    'id' => $raceDistance->distance_id,
                    'label' => $raceDistance->distance->label,
                    'type' => RaceDistanceRef::getTypeArray()[$raceDistance->type],
                    'price' => $raceDistance->price,
                ];
            }

            $result[] = [
                'id' => $race->id,
                'label' => $race->label,
                'start_date' => $race->start_date,
                'race_price' => $race->price,
                'currency' => $race->currency,
                'distances' => $distances,
            ];

        }
        return $result;
    }

    public function auth() {
        $api_key = Yii::$app->request->headers->get('Authorization');

        $organizer = Organizer::find()->where(['api_key' => $api_key])->one();

        if (!$organizer || empty($api_key)) {
            throw new HttpException(404,'The requested page does not exist.');
        }

        return $organizer;
    }
}