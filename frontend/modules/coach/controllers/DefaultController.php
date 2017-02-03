<?php

namespace coach\controllers;

use coach\models\Coach;
use Yii;
use yii\web\Controller;


class DefaultController extends Controller
{
    public function actionIndex() {
        $models = Coach::find()->all();

        return $this->render('index', [
            'models' => $models,
        ]);
    }

}
