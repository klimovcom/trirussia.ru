<?php

namespace coach\controllers;

use coach\models\Coach;
use seo\models\Seo;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class DefaultController extends Controller
{
    public function actionIndex() {
        $models = Coach::find()->all();

        return $this->render('index', [
            'models' => $models,
        ]);
    }

    public function actionView($url) {
        $model = $this->loadModel($url);
        $otherCoaches = Coach::find()->where(['not', ['id' => $model->id]])->all();

        Seo::registerModel($model);

        return $this->render('view', [
            'model' => $model,
            'otherCoaches' => $otherCoaches,
        ]);

    }

    public function loadModel($url) {
        $model = Coach::find()->where(['url' => $url])->one();
        if ($model === null) {
            throw new NotFoundHttpException();
        }

        return $model;
    }

}
