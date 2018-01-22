<?php

namespace api\modules\titan\controllers;

use api\modules\titan\models\TitanRegistration;
use Yii;
use yii\rest\Controller;

class TitanController extends Controller
{
    public function beforeAction($event) {
        $this->setHeaders();
        return parent::beforeAction($event);
    }

    public function actionCreate()
    {
        $titanRegistration = new TitanRegistration();
        $titanRegistration->load(Yii::$app->request->post(), '');

        $result = [
            'status' => 'error',
        ];

        if (!$titanRegistration->validate()) {
            Yii::$app->response->setStatusCode(400);
            $result['message'] = $titanRegistration->getErrors();
            return $result;
        }

        if ($titanRegistration->save()) {
            $result['status'] = 'success';
        }
        
        return $result;
    }

    private function setHeaders() {
        Yii::$app->response->headers->set('Access-Control-Allow-Origin', '*');
        Yii::$app->response->headers->set('Access-Control-Allow-Headers', 'Authorization');

        $this->checkOptions();
    }

    public function checkOptions() {
        $methods = [
            'POST',
            'OPTIONS',
        ];
        if (Yii::$app->request->method == 'OPTIONS') {
            Yii::$app->response->headers->set('Allow', implode(', ', $methods));
            Yii::$app->end();
        }

    }
}