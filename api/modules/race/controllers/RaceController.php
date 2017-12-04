<?php

namespace api\modules\race\controllers;

use Yii;
use api\modules\user\models\User;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;

class RaceController extends Controller
{
    public function beforeAction($event) {
        $this->setHeaders();
        $this->auth();
        return parent::beforeAction($event);
    }

    public function actionIndex()
    {
        return $this->module->get('race.manager')->index();
    }

    private function auth() {
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

    private function setHeaders() {
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