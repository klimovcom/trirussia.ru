<?php

namespace promocode\controllers;

use promocode\models\Promocode;
use yii\web\NotFoundHttpException;
use yii\web\Controller;

/**
 * Default controller for the `configuration` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $models = Promocode::find()->published()->all();

        return $this->render('index', [
            'models' => $models,
        ]);
    }

    public function loadPromocode($url) {
        $model = Promocode::find()->where(['url' => $url])->published()->one();
        if ($model === null) {
            throw new NotFoundHttpException();
        }

        return $model;
    }
}
