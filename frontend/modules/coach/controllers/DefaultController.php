<?php

namespace coach\controllers;

use coach\models\Coach;
use seo\models\Seo;
use sport\models\Sport;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\components\CountryList;


class DefaultController extends Controller
{
    public function actionIndex() {
        $models = Coach::find()->published()->all();

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

    public function actionCreate() {
        $model = new Coach();
        $model->country = 'Россия';
        $countryList = (new CountryList())->getCountryDropDown();
        $sportsArray = ArrayHelper::map(Sport::find()->published()->all(), 'id', 'label');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('trainer-create-success', 'Данные успешно сохраненны и ожидают модерации');

        }

        return $this->render('create', [
            'model' => $model,
            'countryList' => $countryList,
            'sportsArray' => $sportsArray,
        ]);
    }

    public function loadModel($url) {
        $model = Coach::find()->where(['url' => $url])->published()->one();
        if ($model === null) {
            throw new NotFoundHttpException();
        }

        return $model;
    }

}
