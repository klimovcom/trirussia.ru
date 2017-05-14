<?php

namespace race\controllers;

use common\models\UserInfo;
use organizer\models\Organizer;
use race\models\Race;
use race\models\RaceDistanceRef;
use race\models\RaceRegistration;
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
                    'price' => $raceDistance->price ? $raceDistance->price : $race->price,
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

    public function actionView($id) {
        $organizer = $this->auth();
        $model = $this->findModel($id, $organizer->id);
        Yii::info($organizer->id);
        Yii::info($model->id);

        $distances = [];
        foreach ($model->raceDistanceRefs as $raceDistance) {
            $raceRegistrations = RaceRegistration::find()->where(['race_id' => $model->id, 'distance_id' => $raceDistance->distance_id, 'distance_type' => $raceDistance->type])->all();
            $racers = [];
            foreach ($raceRegistrations as $raceRegistration) {
                $userInfo = $raceRegistration->user->userInfo;
                $racers[] = [
                    'first_name' => $userInfo->first_name,
                    'last_name' => $userInfo->last_name,
                    'gender' => UserInfo::getGenderArray()[$userInfo->gender],
                    'birthdate' => $userInfo->birthdate,
                    'city' => $userInfo->city,
                    'email' => $userInfo->email,
                    'phone' => $userInfo->phone,
                    'emergency_first_name' => $userInfo->emergency_first_name,
                    'emergency_last_name' => $userInfo->emergency_last_name,
                    'emergency_phone' => $userInfo->emergency_phone,
                    'emergency_relation' => $userInfo->emergency_relation,
                    'team' => $userInfo->team,
                    'shirt_size' => $userInfo->shirt_size,
                ];
            }

            $distances[] = [
                'id' => $raceDistance->distance_id,
                'label' => $raceDistance->distance->label,
                'type' => RaceDistanceRef::getTypeArray()[$raceDistance->type],
                'price' => $raceDistance->price ? $raceDistance->price : $model->price,
                'racers' => $racers,
            ];
        }
        $result = [
            'id' => $model->id,
            'label' => $model->label,
            'start_date' => $model->start_date,
            'race_price' => $model->price,
            'currency' => $model->currency,
            'distances' => $distances,
        ];

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

    public function findModel($id, $organizer_id) {
        $model = Race::find()->where(['id' => $id, 'organizer_id' => $organizer_id])->one();
        if ($model !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }
}