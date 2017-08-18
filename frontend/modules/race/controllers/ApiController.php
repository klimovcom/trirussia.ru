<?php

namespace race\controllers;

use common\models\User;
use common\models\UserInfo;
use organizer\models\Organizer;
use race\models\Race;
use race\models\RaceDistanceRef;
use race\models\RaceRegistration;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;
use yii\web\UnauthorizedHttpException;

class ApiController extends Controller {

    public function beforeAction($event) {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $this->setHeaders();

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

    public function actionList() {
        $this->user_auth();
        
        $result = [
            'status' => 'error',
        ];

        $races = Race::find()->where(['>=', 'start_date', date('Y-m-d', time())])->published()->all();

        $data = ArrayHelper::toArray($races, [
            'race\models\Race' => [
                'id',
                'label',
                'start_date',
                'organizer' => function($race) {
                    return $race->organizer->label;
                },
                'sport'  => function($race) {
                    return $race->sport->label;
                },
                'country',
                'region',
                'place',
                'popularity',
            ],
        ]);

        $result['status'] = 'success';
        $result['data'] = $data;

        return $result;
    }

    //organizer auth
    public function auth() {
        $api_key = Yii::$app->request->headers->get('Authorization');

        $organizer = Organizer::find()->where(['api_key' => $api_key])->one();

        if (!$organizer || empty($api_key)) {
            throw new UnauthorizedHttpException();
        }

        return $organizer;
    }

    public function user_auth() {
        $api_key = Yii::$app->request->headers->get('Authorization');

        $user = User::find()->where(['api_key' => $api_key])->one();

        if (!$user || empty($api_key)) {
            $data = [
                'status' => 'error',
                'message' => 'Неверный ключ авторизации',
            ];
            Yii::$app->response->statusCode = 401;
            Yii::$app->response->data = $data;
            Yii::$app->end();

            return false;
        }

        return true;
    }

    public function findModel($id, $organizer_id) {
        $model = Race::find()->where(['id' => $id, 'organizer_id' => $organizer_id])->one();
        if ($model !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

    public function setHeaders() {
        Yii::$app->response->headers->set('Access-Control-Allow-Origin', '*');
        Yii::$app->response->headers->set('Access-Control-Allow-Headers', 'Authorization');

        $this->checkOptions();
    }

    public function checkOptions() {
        $methods = [
            'GET',
            'OPTIONS',
        ];
        if (Yii::$app->request->method == 'OPTIONS') {
            Yii::$app->response->headers->set('Allow', implode(', ', $methods));
            Yii::$app->end();
        }

    }
}